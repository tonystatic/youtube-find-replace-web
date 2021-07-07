<?php

declare(strict_types=1);

namespace App\Features\Api\Support;

class VideoItem
{
    protected string $id;

    protected string $title;

    protected string $description;

    protected string $cover;

    public function __construct(string $id, string $title, string $description, string $cover)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->cover = $cover;
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function getCover() : string
    {
        return $this->cover;
    }
}
