<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PDOException;
use App\Helpers\ApiResponse;

class Handler extends ExceptionHandler
{
    protected $levels = [
        //
    ];

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

 
    public function render($request, Throwable $e)
    {
      
        if ($e instanceof ModelNotFoundException) {
            return ApiResponse::sendResponse(404, 'Record not found', null);
        }

   
        if ($e instanceof PDOException) {
            $message = config('app.debug') 
                ? $e->getMessage() 
                : 'Database connection failed, please try again later.';
            return ApiResponse::sendResponse(500, $message, null);
        }

      
        if ($e instanceof QueryException) {
            $message = config('app.debug') 
                ? $e->getMessage() 
                : 'Database query error.';
            return ApiResponse::sendResponse(500, $message, null);
        }

       

        return parent::render($request, $e);
    
    }
}

