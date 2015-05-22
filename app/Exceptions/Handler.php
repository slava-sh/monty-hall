<?php namespace App\Exceptions;

use StatusCode;
use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        'Symfony\Component\HttpKernel\Exception\HttpException',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e) {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e) {
        if ($e instanceof TokenMismatchException) {
            abort(StatusCode::HTTP_UNPROCESSABLE_ENTITY);
        }
        return parent::render($request, $e);
    }

    public function renderHttpException(HttpException $e) {
        $status = $e->getStatusCode();
        if (400 <= $status && $status < 500) {
            $message = $e->getMessage() ?: StatusCode::$statusTexts[$status];
            $data = compact(['status', 'message']);
            return response()->view('errors.4xx', $data, $status);
        }
        return parent::renderHttpException($e);
    }
}
