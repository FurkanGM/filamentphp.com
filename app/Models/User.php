<?php

namespace App\Models;

use App\Services\StripeService;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Stripe\Account;
use Stripe\AccountLink;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use HasFactory;
    use Notifiable;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'immutable_datetime',
        'is_admin' => 'boolean',
    ];

    public function plugins(): HasMany
    {
        return $this->hasMany(Plugin::class, 'author_id');
    }

    public function canAccessFilament(): bool
    {
        return true;
    }
}
