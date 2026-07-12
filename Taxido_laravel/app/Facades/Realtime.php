<?php

namespace App\Facades;

use App\Services\RealtimeManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void registerHandler(string $collection, mixed $handler)
 * @method static void handle(string $collection, string $docId, array $data, string $operation = 'update')
 *
 * @see \App\Services\RealtimeManager
 */
class Realtime extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return RealtimeManager::class;
    }
}
