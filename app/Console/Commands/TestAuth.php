<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TestAuth extends Command
{
    protected $signature = 'auth:test {email} {password}';
    protected $description = 'Test authentication';

    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        $this->info("Testing authentication for: {$email}");

        // Find user
        $user = User::where('email', $email)->first();
        if (!$user) {
            $this->error("User not found");
            return 1;
        }

        $this->info("User found: {$user->name}");
        $this->info("Roles: " . $user->roles->pluck('name')->join(', '));

        // Test password verification
        $passwordMatches = Hash::check($password, $user->password);
        $this->info("Password matches: " . ($passwordMatches ? 'YES' : 'NO'));

        // Test authentication
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $this->info("Authentication: SUCCESS");
            Auth::logout();
        } else {
            $this->error("Authentication: FAILED");
        }

        return 0;
    }
}
