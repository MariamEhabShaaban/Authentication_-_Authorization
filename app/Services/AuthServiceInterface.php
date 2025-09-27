<?php

namespace App\Services;

use App\Models\User;


interface AuthServiceInterface{
    
    public function register(array $user);
    public function login(array $user);
    public function logout(User $user);

}