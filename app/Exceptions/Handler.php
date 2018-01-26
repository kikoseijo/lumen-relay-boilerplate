<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Http\Exception\HttpResponseException;
use Symfony\Component\Debug\Exception\FatalThrowableError;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        // if (env('APP_DEBUG')) {
        //     return parent::render($request, $e);
        // }
        $response = [
            'success' => false
        ];
        $response['status']   = null;

        if ($e instanceof HttpResponseException) {
            $response['status']   = Response::HTTP_INTERNAL_SERVER_ERROR;
        // } elseif ($e instanceof Tymon\JWTAuth\Exceptions\TokenExpiredException) {
        //     $response['status'] = 'token_expired';
        //     $response['error_code'] = $e->getStatusCode();
      	// } else if ($e instanceof Tymon\JWTAuth\Exceptions\TokenInvalidException) {
        //     $response['status'] = 'token_invalid';
        //     $response['error_code'] = $e->getStatusCode();
      	} elseif ($e instanceof MethodNotAllowedHttpException) {
            $response['status'] = Response::HTTP_METHOD_NOT_ALLOWED;
        } elseif ($e instanceof NotFoundHttpException) {
            $response['status'] = Response::HTTP_NOT_FOUND;
        } elseif ($e instanceof AuthorizationException) {
            $response['status'] = Response::HTTP_FORBIDDEN;
            $e      = new AuthorizationException('HTTP_FORBIDDEN', $response['status']);
        } elseif ($e instanceof ValidationException && $e->getResponse()) {
            $response['status']   = Response::HTTP_BAD_REQUEST;
            $e        = new ValidationException('HTTP_BAD_REQUEST', $response['status'], $e);
        } elseif ($e instanceof ValidationException) {
            $response['status']   = 422;
            $response['errors'] = $e->validator->errors();
        } elseif ($e instanceof ModelNotFoundException) {
          $response['status'] = 404;
        } elseif ($e instanceof UnableToExecuteRequestException) {
            $response['status'] = $e->getCode();
        } elseif ($e instanceof FatalThrowableError) {
            $response['status'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        } elseif ($e) {
            $response['status'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $response['unhandled'] = 'exception-lumen-ksoft';
        }

        if ($response['status']) {
            $response['message'] = $e->getMessage();
            if (array_has($response, 'error_code')){
                $response['error_code'] = $e->getCode() ?? '';
            }
            // $response['exception'] = $e->getTraceAsString() ?? '';
            if (app()->environment() == 'local'){
                $response['file'] = $e->getFile() ?? '';
                $response['line'] = $e->getLine() ?? '';
            }
            return response()->json($response, $response['status']);
        } else {
            return parent::render($request, $e);
        }

    }
}
