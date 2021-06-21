<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\Channel.
 *
 * @property int $id
 * @property string $external_id
 * @property string $title
 * @property string|null $avatar
 * @property string|null $access_token
 * @property string|null $refresh_token
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Channel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Channel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Channel query()
 * @mixin \Eloquent
 */
class Channel extends Authenticatable
{
    protected $table = 'channels';

    protected $fillable = [
        'external_id',
        'title', 'avatar',
        'access_token', 'refresh_token',
    ];

    protected $hidden = [
        'remember_token',
    ];
}
