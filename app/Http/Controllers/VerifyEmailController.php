<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;

class VerifyEmailController extends Controller
{

    public function verifyEmail(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (!$user->hasVerifiedEmail() && hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            $user->markEmailAsVerified();
            event(new Verified($user));
            return response()->json(['message' => 'Email verified successfully'], 200);
        }
    
        return response()->json(['message' => 'Invalid verification link'], 422);
    }
}