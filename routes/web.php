<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('pages.home');
});



Route::get('/stream', function () {

    $token = 'YOUR_LIVEKIT_TOKEN';

    $livekitUrl = env('LIVEKIT_URL');

    $isHost = true;

    return view('stream', [
        'token' => $token,
        'livekitUrl' => $livekitUrl,
        'isHost' => $isHost,
    ]);
});



Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', function (Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    });

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', function (Request $request) {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'string', 'regex:/^\+?[0-9]{10,15}$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'password' => bcrypt($validated['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended('/');
    });


    Route::get('/auth/google', function () {
        return Socialite::driver('google')->redirect();
    })->name('auth.google');

    Route::get('/auth/google/callback', function () {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Engineer Standard: Use updateOrCreate to handle existing users
            // and update their tokens without crashing.
            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'google_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken,
                    // If the user already exists, keep their password. If new, generate one.
                    'password' => User::where('email', $googleUser->getEmail())->value('password')
                        ?? bcrypt(Str::random(24)),
                    'email_verified_at' => now(), // Automatically verify Google users
                ]
            );

            Auth::login($user, true); // Log in and 'Remember Me'

            request()->session()->regenerate();

            return redirect()->intended('/');
        } catch (\Exception $e) {
            // Log the error for your debugging
            Log::error('Google Auth Failed: ' . $e->getMessage());

            return redirect('/')->withErrors([
                'email' => 'Unable to authenticate with Google. Please try again.',
            ]);
        }
    })->name('auth.google.callback');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});