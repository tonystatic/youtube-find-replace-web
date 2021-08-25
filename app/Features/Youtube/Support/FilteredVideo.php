<?php

declare(strict_types=1);

namespace App\Features\Youtube\Support;

use App\Features\Api\Support\VideoItem;

class FilteredVideo
{
    protected VideoItem $video;

    protected bool $inTitle;

    protected bool $inDescription;

    public function __construct(VideoItem $video, bool $inTitle, bool $inDescription)
    {
        $this->video = $video;
        $this->inTitle = $inTitle;
        $this->inDescription = $inDescription;
    }

    public function attributes() : VideoItem
    {
        return $this->video;
    }

    public function inTitle() : bool
    {
        return $this->inTitle;
    }

    public function inDescription() : bool
    {
        return $this->inDescription;
    }

    public function __serialize() : array
    {
        return [
            'video'         => serialize($this->video),
            'inTitle'       => $this->inTitle,
            'inDescription' => $this->inDescription,
        ];
    }

    public function __unserialize(array $data) : void
    {
        $this->video = unserialize($data['video']);
        $this->inTitle = $data['inTitle'];
        $this->inDescription = $data['inDescription'];
    }
}
