<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'email',
    ];

    protected $hidden = [
        'remember_token',
    ];

    // Relations

    public function channels() : HasMany
    {
        return $this->hasMany(Channel::class, 'owner_id');
    }
}
