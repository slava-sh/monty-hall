<?php

namespace App\Exceptions;

use StatusCode;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function renderHttpException(HttpExceptionInterface $e) {
        $status = $e->getStatusCode();
        if (400 <= $status && $status < 500) {
            $message = $e->getMessage() ?: StatusCode::$statusTexts[$status];
            $data = compact(['status', 'message']);
            return response()->view('errors.4xx', $data, $status);
        }
        return parent::renderHttpException($e);
    }
}
