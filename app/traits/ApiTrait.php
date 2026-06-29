<?php

namespace App\traits;

trait ApiTrait
{



    public function success($message = '', $code = 200)
    {

        return response()->json([

            'message' => $message,
            'error' => (object)[],
            'data' => (object)[],
        ], $code);
    }

    public function error($error = [], $message = '', $code = 404)
    {

        return response()->json([
            'message' => $message,
            'error' => $error,
            'data' => (object)[],
        ], $code);
    }


    public function data($data = [], $message = '', $code = 200)
    {

        return response()->json([

            'message' => $message,
            'error' => (object)[],
            'data' => $data,
        ], $code);
    }
}
