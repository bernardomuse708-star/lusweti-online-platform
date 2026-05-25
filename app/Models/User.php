<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel; // <--- YOU MUST IMPORT THIS
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles; 

class User extends Authenticatable implements FilamentUser
{
    use HasRoles, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'phone_number', 'email_verified_at','google_id',
        'google_token',
        'google_refresh_token',
        'last_login_at',
        'last_login_ip',];
    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime','last_login_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

     /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Use the trait method correctly
        return $this->hasRole(['Super Admin', 'Admin']);
    }
}