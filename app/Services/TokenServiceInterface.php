<?php

namespace App\Services;

use App\Models\User;


interface TokenServiceInterface{

    public function createToken(User $user) ;
    public function revokeToken($token) ;
}


