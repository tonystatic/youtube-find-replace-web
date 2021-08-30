<?php

declare(strict_types=1);

namespace App\Features\Api\Support;

class VideoItems
{
    /* @var \App\Features\Api\Support\ShortVideoItem[]|\App\Features\Api\Support\FullVideoItem[]|array */
    protected array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function add(ShortVideoItem | FullVideoItem $videoItem) : void
    {
        $this->items[$videoItem->getId()] = $videoItem;
    }

    public function getById(string $id) : ShortVideoItem | FullVideoItem | null
    {
        return $this->items[$id] ?? null;
    }

    /**
     * @return \App\Features\Api\Support\FullVideoItem[]|\App\Features\Api\Support\ShortVideoItem[]|array
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
