<?php

declare(strict_types=1);

namespace App\Features\Api\Support;

class VideoItems
{
    /* @var \App\Features\Api\Support\VideoItem[]|array */
    protected array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function add(VideoItem $videoItem) : void
    {
        $this->items[$videoItem->getId()] = $videoItem;
    }

    public function getById(string $id) : ?VideoItem
    {
        return $this->items[$id] ?? null;
    }

    /**
     * @return \App\Features\Api\Support\VideoItem[]|array
     */
    public function all() : array
    {
        return $this->items;
    }

    public function isEmpty() : bool
    {
        return empty($this->items);
    }

    public function isNotEmpty() : bool
    {
        return ! $this->isEmpty();
    }
}
