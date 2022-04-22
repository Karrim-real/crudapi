<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
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
        $this->renderable(function(NotFoundHttpException $e, $request){
            if($request->is('api/*')){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Url Not Found'
                ], 404);
            }
        });
    }
    // public function render($request, Throwable $exception)
    // {
    //     if($exception instanceof ModelNotFoundException && $request->wantsJson()){
    //         return response()->json(['message' => 'Url Not Found!', 404]);
    //     }
    //     return parent::render($request, $exception);
    // }
}
