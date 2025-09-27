<?php

namespace App\Http\Controllers\Auth;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthServiceInterface;
use App\Http\Requests\Api\RegisterRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{

    private $authService ;

    public function __construct(AuthServiceInterface $authService){
        $this->authService = $authService;

    }
    public function store(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = $this->authService->register($data);

        return ApiResponse::sendResponse(200,'registerd successfully',$user);
    }
}
