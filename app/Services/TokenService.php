<?php

namespace App\Services;


use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Resources\Api\AuthResource;


class TokenService implements TokenServiceInterface
{
   

    public function createToken(User $user) {
        return $user->createToken('auth_token')->plainTextToken;
    }

    public function revokeToken($token) {
        $token->delete();
    }


}
