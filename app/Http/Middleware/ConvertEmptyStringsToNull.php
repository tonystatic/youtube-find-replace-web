<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull as Middleware;

class ConvertEmptyStringsToNull extends Middleware
{
    /**
     * The names of the attributes that should not be transformed.
     *
     * @var array
     */
    protected $except = [
        'replace',
    ];

    /**
     * Transform the given value.
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    protected function transform($key, $value)
    {
        if (\in_array($key, $this->except, true)) {
            return $value;
        }

        return parent::transform($key, $value);
    }
}
