<?php

namespace App\Exceptions;

use Exception;

class HandleException extends Exception
{
    public function __construct(string $message = "Something went wrong.", int $code = 400)
    {
        parent::__construct($message, $code);
    }

    public function render($request)
    {
        // Custom response for the exception
        // return response()->json([
        //     'error' => true,
        //     'message' => $this->getMessage(),
        // ], $this->getCode());

        return redirect()->route('dashboard')->with('error', $this->getMessage());
    }

}
