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
 * @property string $uploads_playlist_id
 * @property string|null $access_token
 * @property string|null $refresh_token
 * @property int|null $token_created_at
 * @property int|null $token_expires_in
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $link
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
        'uploads_playlist_id',
        'access_token', 'refresh_token', 'token_created_at', 'token_expires_in',
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'token_created_at' => 'integer',
        'token_expires_in' => 'integer',
    ];

    // --------------------------------------------------
    // Accessors

    public function getLinkAttribute() : string
    {
        return "https://www.youtube.com/channel/{$this->external_id}";
    }
}
