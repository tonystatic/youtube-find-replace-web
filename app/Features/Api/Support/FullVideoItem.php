<?php

declare(strict_types=1);

namespace App\Features\Api\Support;

class FullVideoItem extends ShortVideoItem
{
    protected ?string $categoryId;

    protected ?string $defaultLanguage;

    protected array $tags;

    protected ?string $defaultAudioLanguage;

    public function __construct(
        string $id,
        string $title,
        ?string $description,
        string $cover,
        array $tags = [],
        string $categoryId = null,
        string $defaultLanguage = null,
        string $defaultAudioLanguage = null
    ) {
        parent::__construct($id, $title, $description, $cover);

        $this->tags = $tags;
        $this->categoryId = $categoryId;
        $this->defaultLanguage = $defaultLanguage;
        $this->defaultAudioLanguage = $defaultAudioLanguage;
    }

    public function getTags() : array
    {
        return $this->tags;
    }

    public function getCategoryId() : ?string
    {
        return $this->categoryId;
    }

    public function getDefaultLanguage() : ?string
    {
        return $this->defaultLanguage;
    }

    public function getDefaultAudioLanguage() : ?string
    {
        return $this->defaultAudioLanguage;
    }

    public function __serialize() : array
    {
        return array_merge(parent::__serialize(), [
            'tags'            => $this->tags,
            'categoryId'      => $this->categoryId,
            'defaultLanguage' => $this->defaultLanguage,
        ]);
    }

    public function __unserialize(array $data) : void
    {
        parent::__unserialize($data);

        $this->tags = $data['tags'];
        $this->categoryId = $data['categoryId'];
        $this->defaultLanguage = $data['defaultLanguage'];
    }
}
