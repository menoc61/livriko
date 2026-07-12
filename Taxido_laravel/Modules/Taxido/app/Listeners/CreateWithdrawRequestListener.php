<?php

namespace Modules\Taxido\Listeners;

use Exception;
use App\Models\User;
use App\Enums\RoleEnum;
use Illuminate\Support\Facades\Log;
use Modules\Taxido\Events\CreateWithdrawRequestEvent;
use Modules\Taxido\Services\NotificationService;

class CreateWithdrawRequestListener
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the event.
     */
    public function handle(CreateWithdrawRequestEvent $event)
    {
        try {
            $admin = User::role(RoleEnum::ADMIN)->first();
            if ($admin) {
                $driver = User::find($event->withdrawRequest->driver_id);
                $placeholders = [
                    'driver_name' => $driver ? $driver->name : 'N/A',
                    'amount' => $event->withdrawRequest->amount,
                ];

                $this->notificationService->send(
                    $admin,
                    'create-withdraw-request-admin',
                    $placeholders,
                    ['type' => 'withdraw_request', 'id' => (string)$event->withdrawRequest->id]
                );
            }

        } catch (Exception $e) {
            Log::error("CreateWithdrawRequestListener: " . $e->getMessage());
        }
    }
}
