<?php

namespace Modules\Taxido\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\ExceptionHandler;
use Illuminate\Support\Facades\DB;

class ChatImageController extends Controller
{
    /**
     * Upload an image for chat.
     * This replaces Firebase Storage. The client uploads here first,
     * gets a URL, and then sends the URL via Socket.io.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB limit
        ]);

        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {
                // Using standard Taxido attachment helpers
                $attachments = createAttachment();
                $media = storeImage([$request->image], $attachments, 'chat_attachment');
                
                $image = head($media);
                
                if (!$image) {
                    throw new Exception('Failed to upload image.', 500);
                }

                DB::commit();

                return response()->json([
                    'success' => true,
                    'url' => str_replace(url('/'), '', $image->original_url),
                    'id' => $image->id,
                ], 200);
            }

            throw new Exception('No image file provided.', 400);

        } catch (Exception $e) {
            DB::rollback();
            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }
}
