<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Features\Youtube\Support\AuthExpiredException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register() : void
    {
        $this->reportable(function (AuthExpiredException $e) {
            auth()->logout();
            flash()->warning($e->getMessage());

            return redirect()->route('main');
        })->stop();
    }
}
