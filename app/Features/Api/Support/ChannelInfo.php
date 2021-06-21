<?php

declare(strict_types=1);

namespace App\Features\Api\Support;

class ChannelInfo
{
    protected string $id;

    protected string $title;

    protected ?string $avatar;

    public function __construct(string $id, string $title, string $avatar = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->avatar = $avatar;
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getAvatar() : ?string
    {
        return $this->avatar;
    }
}
