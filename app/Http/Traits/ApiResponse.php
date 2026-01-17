<?php

namespace App\Http\Traits;

trait ApiResponse
{
    protected function ok($message,$data=[]): \Illuminate\Http\JsonResponse
    {
        return $this->success($message, $data=[],200);
    }

    protected function success($message, $data,$code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            "data" => $data,
            'status' => $code,
            'message' => $message
        ], $code);
    }

    protected function error($message, $code): \Illuminate\Http\JsonResponse
    {
        return response()->json([

            'message' => $message,
            'status' => $code,
        ], $code);
    }

}
