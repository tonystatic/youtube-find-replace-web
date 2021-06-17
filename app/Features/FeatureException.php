<?php

declare(strict_types=1);

namespace App\Features;

use Exception;
use Throwable;

abstract class FeatureException extends Exception
{
    public function __construct(Throwable $previous = null, string $message = '', int $code = 0)
    {
        parent::__construct($message, $code, $previous);
    }
}
