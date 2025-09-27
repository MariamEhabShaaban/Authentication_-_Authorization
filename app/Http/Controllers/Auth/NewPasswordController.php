<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Services\PasswordServiceInterface;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Auth\ResetPasswordRequest;

class NewPasswordController extends Controller
{

    
    private $passwordService;

    public function __construct(PasswordServiceInterface $passwordService){
        $this->passwordService = $passwordService;
    }
    

    public function store(ResetPasswordRequest $request): JsonResponse
    {
        $data = $request->validated();
       
        $status = $this->passwordService->ResetPassword($data['email'],$data['password'],$data['token']);
        if ($status != Password::PASSWORD_RESET) {
             return ApiResponse::sendResponse(422,__($status),[]);
        }
        

         return ApiResponse::sendResponse(200,__($status),[]);
        }
    }

