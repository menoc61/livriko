<?php

namespace Modules\Taxido\Listeners;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Taxido\Events\NotifyDriverDocStatusEvent;
use Modules\Taxido\Services\NotificationService;

class NotifyDriverDocStatusListener
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the event.
     */
    public function handle(NotifyDriverDocStatusEvent $event): void
    {
        try {
            $driver = $event->driver;
            $document = $event->document;

            if ($driver) {
                $placeholders = [
                    'driver_name' => $driver->name,
                    'document_name' => $document->name,
                    'status' => ucfirst($document->status),
                ];

                $this->notificationService->send(
                    $driver,
                    'driver-document-status-update',
                    $placeholders,
                    ['type' => 'driver_document_status', 'document_id' => (string)$document->id]
                );
            }

        } catch (Exception $e) {
            Log::error("NotifyDriverDocStatusListener: " . $e?->getMessage());
        }
    }
}
