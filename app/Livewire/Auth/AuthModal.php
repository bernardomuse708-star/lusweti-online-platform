<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Attributes\On;

class AuthModal extends Component
{
    public bool $isOpen = false;
    public string $tab = 'login'; // Supported values: 'login', 'register', 'forgot'

    // Login form properties
    public string $loginEmail = '';
    public string $loginPassword = '';

    // Register form properties
    public string $registerName = '';
    public string $registerEmail = '';
    public string $registerPassword = '';
    public string $registerPasswordConfirmation = '';

    // Forgot password form properties
    public string $forgotEmail = '';

    #[On('open-auth-modal')]
    public function openModal(array $params = []): void
    {
        $this->tab = $params['tab'] ?? 'login';
        $this->isOpen = true;
        $this->resetForm();
    }

    #[On('close-auth-modal')]
    public function closeModal(): void
    {
        $this->isOpen = false;
        $this->resetForm();
    }

    public function switchTab(string $targetTab): void
    {
        if (in_array($targetTab, ['login', 'register', 'forgot'])) {
            $this->tab = $targetTab;
            $this->resetForm();
        }
    }

    public function login(): void
    {
        $this->validate([
            'loginEmail' => 'required|email',
            'loginPassword' => 'required',
        ]);

        if (Auth::attempt(['email' => $this->loginEmail, 'password' => $this->loginPassword])) {
            session()->regenerate();
            $this->isOpen = false;
            $this->redirect('/', navigate: true);
            return;
        }

        throw ValidationException::withMessages([
            'loginEmail' => 'Barua pepe au neno la siri si sahihi.',
        ]);
    }

    public function register(): void
    {
        $this->validate([
            'registerName' => 'required|string|max:255',
            'registerEmail' => 'required|email|max:255|unique:users,email',
            'registerPassword' => 'required|string|min:8|same:registerPasswordConfirmation',
        ]);

        $user = User::create([
            'name' => $this->registerName,
            'first_name' => $this->registerName,
            'email' => $this->registerEmail,
            'password' => Hash::make($this->registerPassword),
        ]);

        Auth::login($user);
        session()->regenerate();

        $this->isOpen = false;
        $this->redirect('/', navigate: true);
    }

    public function forgotPassword(): void
    {
        $this->validate([
            'forgotEmail' => 'required|email',
        ]);

        $status = Password::sendResetLink(['email' => $this->forgotEmail]);

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('status', __($status));
            $this->isOpen = false;
            return;
        }

        throw ValidationException::withMessages([
            'forgotEmail' => __($status),
        ]);
    }

    private function resetForm(): void
    {
        $this->reset([
            'loginEmail', 'loginPassword',
            'registerName', 'registerEmail', 'registerPassword', 'registerPasswordConfirmation',
            'forgotEmail'
        ]);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.auth.auth-modal');
    }
}