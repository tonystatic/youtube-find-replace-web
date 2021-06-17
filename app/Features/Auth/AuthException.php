<?php

declare(strict_types=1);

namespace App\Features\Auth;

use App\Features\FeatureException;
use Throwable;

class AuthException extends FeatureException
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct($previous, 'Authentication failed.');
    }
}
