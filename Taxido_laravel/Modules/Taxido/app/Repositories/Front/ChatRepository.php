<?php

namespace Modules\Taxido\Repositories\Front;

use Exception;
use App\Models\User;
use App\Enums\RoleEnum;
use Modules\Taxido\Models\Rider;
use App\Exceptions\ExceptionHandler;
use Prettus\Repository\Eloquent\BaseRepository;

class ChatRepository extends BaseRepository
{

    public function model()
    {
        return Rider::class;
    }

    public function index()
    {
        try {
            $user = auth()->user();

            $admin = User::role(RoleEnum::ADMIN)->first();
            $token = $user->createToken('front_chat')->plainTextToken;

            return view('taxido::front.account.chat', [
                'user' => $user,
                'admin' => $admin,
                'access_token' => $token
            ]);

        } catch (Exception $e) {
            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }
}