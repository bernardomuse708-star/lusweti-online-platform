<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Password;

class ForgotPasswordForm extends Component
{
    public string $email = '';
    public ?string $statusMessage = null;

    public function sendResetLink(): void
    {
        $this->validate(['email' => 'required|email']);

        // Directly queries Fortify's native setup
        $status = Password::broker(config('fortify.passwords'))->sendResetLink(
            ['email' => $this->email]
        );

        if ($status === Password::RESET_LINK_SENT) {
            $this->statusMessage = __($status);
            $this->reset('email');
        } else {
            $this->addError('email', __($status));
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-password-form');
    }
}