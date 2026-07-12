<?php

namespace Modules\Taxido\Listeners;

use Exception;
use App\Models\User;
use App\Enums\RoleEnum;
use Illuminate\Support\Facades\Log;
use Modules\Taxido\Events\CreateFleetWithdrawRequestEvent;
use Modules\Taxido\Services\NotificationService;

class CreateFleetWithdrawRequestListener
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the event.
     */
    public function handle(CreateFleetWithdrawRequestEvent $event)
    {
        try {
            $admin = User::role(RoleEnum::ADMIN)->first();
            if ($admin) {
                $fleetManager = User::find($event->fleetWithdrawRequest->fleet_manager_id);
                $placeholders = [
                    'fleet_manager_name' => $fleetManager ? $fleetManager->name : 'N/A',
                    'amount' => $event->fleetWithdrawRequest->amount,
                ];

                $this->notificationService->send(
                    $admin,
                    'create-fleet-withdraw-request-admin',
                    $placeholders,
                    ['type' => 'fleet_withdraw_request', 'id' => (string)$event->fleetWithdrawRequest->id]
                );
            }
        } catch (Exception $e) {
            Log::error("CreateFleetWithdrawRequestListener: " . $e->getMessage());
        }
    }
}
