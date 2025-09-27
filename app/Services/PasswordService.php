<?php

namespace App\Services;


use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Resources\Api\AuthResource;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Services\PasswordServiceInterface;

class PasswordService implements PasswordServiceInterface
{
    public function sendEmailResetPassword($email)
    {
        return Password::sendResetLink(['email' => $email]);
    }

    
    public function resetPassword($email, $password, $token)
    {
        $status = Password::reset(
            [
                'email' => $email,
                'password' => $password,
                'password_confirmation' => $password,
                'token' => $token,
            ],
            function ($user) use ($password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status;
    }
}
