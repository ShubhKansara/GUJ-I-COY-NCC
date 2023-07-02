<?php

namespace App\Http\Controllers\Boilerplate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classes\Authenticate;
use function response;

class BaseController extends Controller
{
    protected $allowAction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->allowAction = Authenticate::isAdmin();
    }

    /**
     * success response method.
     *
     * @return Response
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @return Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}
