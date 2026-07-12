<?php

namespace App\Services;

/**
 * RealtimeManager
 * ─────────────────────────────────────────────────────────────────────────────
 * Central registry for handling real-time data syncs across modules.
 * Instead of noisy global events, modules register specific handlers for
 * the data collections they care about.
 */
class RealtimeManager
{
    private array $handlers = [];

    /**
     * Register a handler for a specific data collection.
     * 
     * @param string $collection The collection name (e.g., 'driverTrack')
     * @param mixed $handler A class string or closure to handle the sync
     */
    public function registerHandler(string $collection, $handler): void
    {
        if (!isset($this->handlers[$collection])) {
            $this->handlers[$collection] = [];
        }
        $this->handlers[$collection][] = $handler;
    }

    /**
     * Coordinate the real-time data sync by executing relevant handlers.
     */
    public function handle(string $collection, string $docId, array $data, string $operation = 'update'): void
    {
        $handlers = $this->handlers[$collection] ?? [];

        foreach ($handlers as $handler) {
            $this->executeHandler($handler, $collection, $docId, $data, $operation);
        }
    }

    /**
     * Resolve and execute a specific handler.
     */
    private function executeHandler($handler, string $collection, string $docId, array $data, string $operation): void
    {
        // Resolve from container if it's a class string
        if (is_string($handler) && class_exists($handler)) {
            $instance = app($handler);
            if (method_exists($instance, 'handleSync')) {
                $instance->handleSync($collection, $docId, $data, $operation);
            } elseif (method_exists($instance, 'handle')) {
                $instance->handle($collection, $docId, $data, $operation);
            }
            return;
        }

        // Execute if it's a callable
        if (is_callable($handler)) {
            call_user_func($handler, $collection, $docId, $data, $operation);
        }
    }
}
