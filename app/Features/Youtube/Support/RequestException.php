<?php

declare(strict_types=1);

namespace App\Features\Youtube\Support;

use App\Features\FeatureException;
use Throwable;

class RequestException extends FeatureException
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct($previous, 'Something went wrong. Please, try again later.');
    }
}
