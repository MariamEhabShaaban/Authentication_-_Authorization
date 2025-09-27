<?php

namespace App\Services;


use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Resources\Api\AuthResource;


class AuthService implements AuthServiceInterface
{
    private TokenService $tokenService;

    public function __construct(TokenService $tokenService) {
        $this->tokenService = $tokenService;
    }

    public function login(array $credentials) {
        if (!Auth::attempt($credentials)) {
            throw new \Exception('Invalid credentials');
        }

        $user = Auth::user();
        $token = $this->tokenService->createToken($user);

        return new AuthResource($user, $token);
    }



    public function logout(User $user) {
        $token = $user->currentAccessToken();
        if (!$token) {
            return [
                'success' => false,
                'status' => 401,
                'message' => 'User is not authenticated or token is missing'
            ];
        }
        try {
            $this->tokenService->revokeToken($token);
            return [
                'success' => true,
                'status' => 200,
                'message' => 'Logged out successfully'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'status' => 500,
                'message' => 'Something went wrong while logging out'
            ];
        }
    }

    public function register(array $data) {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        event(new Registered($user));
        $token = $this->tokenService->createToken($user);

        return new AuthResource($user, $token);
    }
}
