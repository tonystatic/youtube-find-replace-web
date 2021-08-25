<?php

declare(strict_types=1);

namespace App\Features\Youtube\Support;

class FilteredVideos
{
    /* @var \App\Features\Youtube\Support\FilteredVideo[]|array */
    protected array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function add(FilteredVideo $video) : void
    {
        $this->items[$video->attributes()->getId()] = $video;
    }

    /**
     * @return \App\Features\Youtube\Support\FilteredVideo[]|array
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

    public function __serialize() : array
    {
        $data = [];
        foreach ($this->items as $item) {
            $data[] = serialize($item);
        }

        return $data;
    }

    public function __unserialize(array $data) : void
    {
        foreach ($data as $itemData) {
            $this->add(unserialize($itemData));
        }
    }
}
