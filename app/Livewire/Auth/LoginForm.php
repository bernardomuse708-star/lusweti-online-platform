<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Features;

class LoginForm extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login(): void
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $this->email)->first();

        if (! $user || ! Hash::check($this->password, $user->password)) {
            $this->addError('email', 'Barua pepe au neno la siri si sahihi.');
            return;
        }

        // ⚡ Fortify 2FA Interception Engine
        if (Features::canManageTwoFactorAuthentication() && isset($user->two_factor_secret)) {
            // Store target authorization ID inside session exactly how Fortify expects it
            session(['fortify.typed_credentials' => [
                'email' => $this->email,
                'password' => $this->password,
                'remember' => $this->remember,
            ]]);
            
            session(['fortify.id' => $user->id]);

            // Seamlessly route them to your pre-existing Fortify 2FA Challenge View
            $this->redirect(route('two-factor.login'));
            return;
        }

        // Standard baseline login if 2FA is unconfigured
        Auth::login($user, $this->remember);
        session()->regenerate();

        $this->dispatch('close-auth-modal');
        $this->redirect(request()->header('Referer') ?? '/', navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.login-form');
    }
}