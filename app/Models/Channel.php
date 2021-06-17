<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Channel extends Model
{
    protected $table = 'channels';

    protected $fillable = [
        'owner_id',
        'external_id', 'title', 'avatar',
    ];

    protected $hidden = [
        'remember_token',
    ];

    // Relations

    public function owner() : BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
