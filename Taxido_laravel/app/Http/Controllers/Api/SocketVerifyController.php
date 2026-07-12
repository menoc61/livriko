<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * SocketVerifyController
 * Called by Node.js server to verify a client's Sanctum token.
 * Returns user info so Node can authorize the socket connection.
 * Tokens are cached in Node for TOKEN_CACHE_TTL seconds.
 */
class SocketVerifyController extends Controller
{
    /**
     * GET /api/socket/verify
     * Headers: Authorization: Bearer <sanctum-token>
     *          X-Socket-Internal-Key: <SOCKET_INTERNAL_KEY>
     */
    public function verify(Request $request)
    {
        // 1. Validate internal key (so only Node.js can call this)
        $internalKey = $request->header('X-Socket-Internal-Key');
        if ($internalKey !== config('socket.internal_key')) {
            \Log::warning('[Socket] Internal Key Mismatch', [
                'received' => $internalKey,
                'expected' => config('socket.internal_key')
            ]);
            return response()->json(['error' => 'Forbidden'], 403);
        }

        // 2. Validate user via Sanctum
        $user = $request->user();
        if (!$user) {
            \Log::warning('[Socket] Unauthorized token attempt');
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Return minimal user info needed by Node.js
        return response()->json([
            'id'   => $user->id,
            'name' => $user->name,
            'role' => $user->getRoleNames()->first() ?? 'user',
        ]);
    }
}
