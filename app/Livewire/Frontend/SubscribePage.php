<?php

namespace App\Livewire\Frontend;

use App\Models\Subscriber;
use Livewire\Component;
use Livewire\Attributes\Validate;

class SubscribePage extends Component
{
    #[Validate('required|email|unique:subscribers,email')]
    public string $email = '';

    #[Validate('nullable|string|max:255')]
    public string $name = '';

    public bool $subscribed = false;

    public function subscribe()
    {
        $this->validate();

        Subscriber::create([
            'email' => $this->email,
            'name' => $this->name ?: null,
            'status' => 'active',
            'subscribed_at' => now(),
        ]);

        $this->subscribed = true;
        $this->email = '';
        $this->name = '';

        $this->dispatch('subscription-success');
    }

    public function render()
    {
        return view('livewire.frontend.subscribe-page');
    }
}
