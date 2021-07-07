<?php

declare(strict_types=1);

namespace App\Features\Api\Support;

class ChannelInfo
{
    protected string $id;

    protected string $title;

    protected string $uploadsPlaylistId;

    protected ?string $avatar;

    public function __construct(string $id, string $title, ?string $avatar, string $uploadsPlaylistId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->avatar = $avatar;
        $this->uploadsPlaylistId = $uploadsPlaylistId;
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getUploadsPlaylistId() : string
    {
        return $this->uploadsPlaylistId;
    }

    public function getAvatar() : ?string
    {
        return $this->avatar;
    }
}
