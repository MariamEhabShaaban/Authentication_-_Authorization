<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\PasswordServiceInterface;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Auth\ForgotPasswordRequest;

class PasswordResetLinkController extends Controller
{


    private $passwordService;

    public function __construct(PasswordServiceInterface $passwordService){
        $this->passwordService = $passwordService;
    }
    
        
    
    public function store(ForgotPasswordRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $status = $this->passwordService->sendEmailResetPassword( $validatedData ['email']);

        if ($status != Password::RESET_LINK_SENT) {
           return ApiResponse::sendResponse(422,__($status),[]);
        }

        return ApiResponse::sendResponse(200,__($status),[]);
    }
}
