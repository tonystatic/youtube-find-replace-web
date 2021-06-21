<?php

declare(strict_types=1);

namespace App\Features\Api\Support;

use App\Features\FeatureException;
use Throwable;

class YoutubeAuthException extends FeatureException
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct($previous, 'YouTube authentication failed.');
    }
}
