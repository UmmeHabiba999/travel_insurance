<?php

namespace App\Http\Traits;

trait ResponseTraits
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($message, $result = [])
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data'    => $result,
        ];


        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $code = 422)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        return response()->json($response, $code);
    }
}
