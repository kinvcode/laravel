<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if ($request->wantsJson()) {
            $statusCode = 500;
            $exception_name = get_class($exception);
//            dump($exception_name);
            switch ($exception_name) {
                case AuthenticationException::class:
                    $response['message'] = 'Please log in and try again.';
                    $response['code'] = 40001;
                    $statusCode = 401;
                    break;
                case NotFoundHttpException::class:
                    $response['message'] = 'Not Found';
                    $response['code'] = 40004;
                    $statusCode = 404;
                    break;
                case MethodNotAllowedHttpException::class:
                    $response['message'] = 'Method Not Allowed';
                    $response['code'] = 40005;
                    $statusCode = 405;
                    break;
                case ValidationException::class:
                    $errors = $exception->errors();
                    foreach ($errors as $error) {
                        $response['message'] = $error[0];
                        break;
                    }
                    $response['code'] = 40022;
                    $statusCode = 422;
                    break;
                case ThrottleRequestsException::class:
                    $response['message'] = 'Too Many Attempts.';
                    $response['code'] = 40029;
                    $statusCode = 429;
                    break;
                default:
                    $response['message'] = 'Server Error';
                    $response['code'] = 50000;
                    break;
            }

            if (env('API_DEBUG')) {
                $response['message'] = $exception->getMessage();
                $response['trace'] = $exception->getTrace();
                $response['code'] = -1;
            }

            $response['request'] = $request->getMethod() . ' ' . $request->path();
            return response()->json($response, $statusCode);
        }
        return parent::render($request, $exception);
    }
}
