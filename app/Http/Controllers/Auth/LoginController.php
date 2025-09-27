<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthServiceInterface;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    private $authService ;

    public function __construct(AuthServiceInterface $authService){
        $this->authService = $authService;

    }

    public function store(LoginRequest $request)
    {
       $credentials = $request->only('email', 'password');
    try {

        $response = $this->authService->login($credentials);
        return ApiResponse::sendResponse(200, 'Login Successfully', $response);

    } catch (\Exception $e) {

        return ApiResponse::sendResponse(401, $e->getMessage(), []);

    }
    }

}
