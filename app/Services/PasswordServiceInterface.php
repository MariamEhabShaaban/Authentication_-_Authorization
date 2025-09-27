<?php

namespace App\Services;


use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Resources\Api\AuthResource;


interface PasswordServiceInterface 
{
    public function sendEmailResetPassword($email);
   public function ResetPassword($email, $password, $token);


}
