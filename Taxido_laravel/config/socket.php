<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Socket.io Node Server URL
    |--------------------------------------------------------------------------
    | The base URL of the Node.js Socket.io server.
    | Must match PORT in socket-server/.env
    */
    'server_url' => env('SOCKET_SERVER_URL', 'http://localhost:3000'),

    'secret' => env('SOCKET_SECRET', ''),

    /*
    |--------------------------------------------------------------------------
    | Internal Key
    |--------------------------------------------------------------------------
    | Used by Node.js for X-Socket-Internal-Key header validation.
    */
    'internal_key' => env('SOCKET_INTERNAL_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Timeouts (milliseconds)
    |--------------------------------------------------------------------------
    | emit_timeout_ms: max wait for fire-and-forget events (non-blocking)
    | read_timeout_ms: max wait for state read responses
    */
    'emit_timeout_ms' => env('SOCKET_EMIT_TIMEOUT_MS', 500),
    'read_timeout_ms' => env('SOCKET_READ_TIMEOUT_MS', 2000),
];
