<?php

declare(strict_types=1);

namespace App\Features\Youtube\Support;

use App\Features\FeatureException;
use Throwable;

class AuthExpiredException extends FeatureException
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct($previous, 'Authentication expired. Please, log in again.');
    }
}
