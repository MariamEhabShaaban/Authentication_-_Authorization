<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthServiceInterface;
use App\Http\Requests\Auth\LoginRequest;

class LogoutController extends Controller
{
    private $authService ;

    public function __construct(AuthServiceInterface $authService){
        $this->authService = $authService;

    }

 
    public function destroy(Request $request)
    {
       $response = $this->authService->logout($request->user());

       return ApiResponse::sendResponse($response['status'],$response['message'],[]);
       
    }
}
