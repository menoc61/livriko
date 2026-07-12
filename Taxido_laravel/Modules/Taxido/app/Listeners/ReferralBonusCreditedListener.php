<?php

namespace Modules\Taxido\Listeners;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Taxido\Events\ReferralBonusCreditedEvent;
use Modules\Taxido\Services\NotificationService;

class ReferralBonusCreditedListener
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the event.
     *
     * @param ReferralBonusCreditedEvent $event
     */
    public function handle(ReferralBonusCreditedEvent $event): void
    {
        try {
            $referralBonus = $event->referralBonus;
            $referrer = $referralBonus->referrer;

            if ($referrer) {
                $placeholders = [
                    'referrer_name' => $referrer->name,
                    'referred_name' => $referralBonus->referred ? $referralBonus->referred->name : 'User',
                    'bonus_amount' => number_format($referralBonus->referrer_bonus_amount, 2),
                    'referred_type' => ucfirst($referralBonus->referred_type),
                ];

                $this->notificationService->send(
                    $referrer,
                    'referral-bonus-credited',
                    $placeholders,
                    ['type' => 'referral_bonus', 'id' => (string)$referralBonus->id]
                );
            }

        } catch (Exception $e) {
            Log::error('ReferralBonusCreditedListener: ' . $e?->getMessage());
        }
    }
}
