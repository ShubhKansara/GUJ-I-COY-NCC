<?php

namespace App\Exceptions;

use Exception;
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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        //this added jatin - chaning token mismatch error
        /* $exception_class = get_class($exception);
        //dd($exception, $exception_class);
        if ($exception instanceof TokenMismatchException || $exception instanceof HttpException || $exception_class = 'Illuminate\Session\TokenMismatchException'){
            // Catch it here and do what you want. For example...
            //return redirect()->back()->withInput()->with('error', 'Your session has expired');

            return redirect()->to('/')
                         ->with('growl', [__('boilerplate::role.successmod'), 'success']);
            return redirect()->to('/')->with('growl', ['Your Session Has Expired!', 'error']);
            return response()->json(['message' =>
                        'Your session has expired. You will need to refresh the page and login again to continue using the system.']
                        , 419);
            //\Auth::logout();
            $response = [
                'success' => false,
                'message' => 'Your session has expired',
                'session_expired' => true
            ];
            return response()->json($response, 422);
        } */
        return parent::render($request, $exception);
    }
}
