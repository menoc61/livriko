<?php

namespace App\Providers;

use App\Services\Guardian;

use App\Enums\RoleEnum;
use App\Facades\WMenu;
use App\Models\Plugin;
use App\Observers\PluginObserver;
use App\Services\BadgeResolver;
use App\Services\RealtimeManager;
use App\Services\SocketService;
use App\Services\WidgetManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Spatie\Translatable\Facades\Translatable;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind('Menu', function () {
            return new WMenu();
        });

        $this->app->singleton(WidgetManager::class, function () {
            return new WidgetManager();
        });

        $this->app->singleton(BadgeResolver::class, function () {
            return new BadgeResolver();
        });

        $this->app->singleton(SocketService::class, function () {
            return new SocketService();
        });

        $this->app->singleton(RealtimeManager::class, function () {
            return new RealtimeManager();
        });
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            if (!config('rate-limiting.enabled', true) || !config('rate-limiting.limiters.api.enabled', true)) {
                return null;
            }

            $limiterName = 'api';
            $limitType = 'ip';
            $ip = $request->ip();
            $key = "{$limiterName}:{$limitType}:{$ip}";
            $violationKey = "{$key}:violations";

            $config = config("rate-limiting.limiters.{$limiterName}");
            $maxAttempts = $config['limits']['ip']['max_attempts'] ?? 60;
            $growthStrategy = $config['growth_strategy'] ?? 'fibonacci';
            $maxSuspensionTime = config('rate-limiting.max_suspension_time', 3600);

            $currentAttempts = RateLimiter::attempts($key);

            if ($currentAttempts >= $maxAttempts) {
                // Increment violations
                RateLimiter::hit($violationKey, 3600);
                $violationCount = RateLimiter::attempts($violationKey);
                $decay = match ($growthStrategy) {
                    'exponential' => min($maxSuspensionTime, 60 * 2 ** $violationCount),
                    'fibonacci' => min($maxSuspensionTime, 60 * (function($n) {
                        if ($n <= 0) return 1;
                        if ($n === 1) return 1;
                        if ($n === 2) return 2;
                        $a = 1; $b = 2;
                        for ($i = 3; $i <= $n; $i++) {
                            $tmp = $a + $b; $a = $b; $b = $tmp;
                        }
                        return $b;
                    })($violationCount)),
                    default => min($maxSuspensionTime, 60 * $violationCount),
                };

                RateLimiter::clear($key);
                for ($i = 0; $i < $maxAttempts; $i++) {
                    RateLimiter::hit($key, $decay);
                }

                $waitMinutes = ceil($decay / 60);
                $messageTemplate = config("rate-limiting.messages.{$limiterName}.{$limitType}")
                    ?? config('rate-limiting.messages.default', 'Too many attempts. Please wait :minutes minutes.');

                $message = str_replace(':minutes', (string)$waitMinutes, $messageTemplate);
                $suggestion = config("rate-limiting.suggestions.{$limiterName}")
                    ?? config('rate-limiting.suggestions.default', 'Please wait before trying again.');

                return response()->json([
                    'status' => 'error',
                    'message' => $message . ' ' . $suggestion,
                    'retry_after' => $decay,
                    'wait_minutes' => $waitMinutes
                ], 429);
            }

            // Normal hit
            RateLimiter::hit($key, 60);

            return null;
        });
        Guardian::bootApplication();
        Paginator::useBootstrap();
        Plugin::observe(PluginObserver::class);
        Translatable::fallback(fallbackAny: true, );
        JsonResource::withoutWrapping();
        Model::automaticallyEagerLoadRelationships();

        Gate::before(function ($user, $ability) {
            return $user->hasRole(RoleEnum::ADMIN) ? true : null;
        });
    }
}
