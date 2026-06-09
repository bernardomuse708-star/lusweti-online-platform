<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Validation\ValidationException;

class RegisterForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone_number = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(CreatesNewUsers$creator): void
    {
        try {
            // Delegate completely to Fortify's underlying registration action
            $user = $creator->create([
                'name' => $this->name,
                'email' => $this->email,
                'phone_number' => $this->phone_number,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
            ]);

            Auth::login($user);
            session()->regenerate();

            $this->dispatch('close-auth-modal');
            $this->redirect(request()->header('Referer') ?? '/', navigate: true);

        } catch (ValidationException $e) {
            foreach ($e->errors() as $key => $messages) {
                $this->addError($key, $messages[0]);
            }
        }
    }

    public function render()
    {
        return view('livewire.auth.register-form');
    }
}