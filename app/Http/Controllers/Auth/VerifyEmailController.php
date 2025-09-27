<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Routing\Controller;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $request, $id, $hash)
    {
     
        if (! $request->hasValidSignature()) {
            return ApiResponse::sendResponse(403, 'Invalid or expired verification link', []);
        }

        $user = User::findOrFail($id);

       
        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return ApiResponse::sendResponse(403, 'Invalid verification data', []);
        }

     
        if ($user->hasVerifiedEmail()) {
            return ApiResponse::sendResponse(200, 'Email already verified', []);
        }

       
        $user->markEmailAsVerified();
        event(new Verified($user));

        return ApiResponse::sendResponse(200, 'Email verified successfully', []);
    }
}
