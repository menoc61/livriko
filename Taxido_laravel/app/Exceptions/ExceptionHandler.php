<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class ExceptionHandler extends Exception
{
    /**
     * Store the original string code from database exceptions.
     */
    protected $originalCode;

    /**
     * Create a new ExceptionHandler instance.
     *
     * @param  string  $message
     * @param  mixed   $code
     * @param  \Throwable|null  $previous
     * @return void
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $this->originalCode = $code;
        $intCode = is_numeric($code) ? (int) $code : 0;
        if ($intCode < 100 || $intCode > 599) {
            $intCode = 500;
        }

        parent::__construct($message, $intCode, $previous);
    }

    /**
     * Report or log an exception.
     *
     * @return bool
     */
    public function report()
    {
        return true;
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function render($request)
    {
        $message = $this->message;
        $statusCode = $this->code;
        if ($this->isDatabaseError($message)) {
            Log::critical("Database Exception: " . $message . " [Original Code: " . $this->originalCode . "]");
            if (!config('app.debug')) {
                $message = __("Something went wrong with the database. Please try again later.");
            }
        } else {
            Log::error("Application Exception: " . $message);
        }

        if ($request->expectsJson()) {
            return $this->apiResponse($message, $statusCode);
        }

        return $this->webResponse($message);
    }

    /**
     * Check if the message or context indicates a database error.
     */
    protected function isDatabaseError($message)
    {
        return str_contains($message, 'SQLSTATE') ||
               str_contains($message, 'QueryException') ||
               str_contains($message, 'PDOException') ||
               str_contains($message, 'Database error');
    }

    /**
     * Handle Web response.
     *
     * @param  string  $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function webResponse($message)
    {
        return redirect()->back()->with('error', $message);
    }

    /**
     * Handle API response.
     *
     * @param  string  $message
     * @param  int  $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiResponse($message, $statusCode)
    {
        $httpStatus = (is_int($statusCode) && $statusCode >= 100 && $statusCode <= 599)
                       ? $statusCode
                       : Response::HTTP_INTERNAL_SERVER_ERROR;

        throw new HttpResponseException(response()->json([
            "message" => $message,
            "success" => false
        ], $httpStatus));
    }
}
