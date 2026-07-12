<?php

namespace Modules\Taxido\Listeners;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Modules\Taxido\Events\UpdateWithdrawRequestEvent;
use Modules\Taxido\Services\NotificationService;

class UpdateWithdrawRequestListener
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function handle(UpdateWithdrawRequestEvent $event): void
    {
        try {
            $withdrawRequest = $event->withdrawRequest;
            $driver = User::find($withdrawRequest->driver_id);

            if ($driver) {
                $placeholders = [
                    'driver_name' => $driver->name,
                    'amount' => $withdrawRequest->amount,
                    'status' => ucfirst($withdrawRequest->status),
                ];

                $this->notificationService->send(
                    $driver,
                    'update-withdraw-request-driver',
                    $placeholders,
                    ['type' => 'withdraw_request', 'id' => (string)$withdrawRequest->id]
                );
            }

        } catch (Exception $e) {
            Log::error("UpdateWithdrawRequestListener: " . $e?->getMessage());
        }
    }
}
