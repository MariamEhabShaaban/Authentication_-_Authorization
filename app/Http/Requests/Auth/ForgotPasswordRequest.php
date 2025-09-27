<?php

namespace App\Http\Requests\Auth;
use App\Models\User;
use App\Helpers\ApiResponse;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
class ForgotPasswordRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }
  

    public function rules(): array
    {
        return [
             'email' => 'required|email',
        ];
    }

       protected function failedValidation(Validator $validator){
        if($this->is('api/*')){
            $response = ApiResponse::sendResponse(422,'fail',$validator->errors());
            throw new ValidationException($validator , $response);
        }
    }
}
