<?php

namespace App\Http\Requests\Api;

use App\Models\User;
use App\Helpers\ApiResponse;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
    protected function failedValidation(Validator $validator){
        if($this->is('api/*')){
            $response = ApiResponse::sendResponse(422,'fail',$validator->errors());
            throw new ValidationException($validator , $response);
        }
    }
}
