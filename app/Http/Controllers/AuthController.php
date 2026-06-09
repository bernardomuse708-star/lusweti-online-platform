<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Match Google credentials to user accounts cleanly
            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'google_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken ?? null,
                    'password' => User::where('email', $googleUser->getEmail())->value('password') 
                        ?? bcrypt(Str::random(24)),
                    'email_verified_at' => now(),
                ]
            );

            Auth::login($user, true);
            request()->session()->regenerate();

            return redirect('/')->with('success', 'Umefanikiwa kuingia!');
            
        } catch (\Exception $e) {
            Log::error('Google Auth Loop Failure: ' . $e->getMessage());
            return redirect('/')->withErrors(['email' => 'Imeshindwa kuunganishwa na Google.']);
        }
    }
}