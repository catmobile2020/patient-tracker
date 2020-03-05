<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

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

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if (!$request->expectsJson())
        {
            return  redirect()->guest(route('admin.login'));
        }
        $result = [
            'type' => request()->fullUrl(),
            'title' => 'Unauthenticated.',
        ];
        throw new HttpResponseException(response()->json($result , 401));
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof UnauthorizedHttpException) {
            $preException = $exception->getPrevious();
            if ($preException instanceof
                \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['error' => 'TOKEN_EXPIRED']);
            } else if ($preException instanceof
                \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['error' => 'TOKEN_INVALID']);
            } else if ($preException instanceof
                \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                return response()->json(['error' => 'TOKEN_BLACKLISTED']);
            }
            if ($exception->getMessage() === 'Token not provided') {
                return response()->json(['error' => 'Token not provided']);
            }
        }

        if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {
            $result = [
                'type' => request()->fullUrl(),
                'title' => 'Resource not found',
            ];
            throw new HttpResponseException(response()->json($result , 404));
        }
        return parent::render($request, $exception);
    }

    protected function invalidJson($request, ValidationException $exception)
    {
        $result = [
            'type' => $request->url(),
            'title' => "Your request parameters didn't validate.",
            'message' => $exception->validator->errors()->all(),
            'errors' => $exception->errors(),
        ];
        throw new HttpResponseException(response()->json($result , $exception->status));
    }
}
