<?php

namespace App\Http\Traits;

trait ApiResponse
{
    protected function ok($message): \Illuminate\Http\JsonResponse
    {
        return $this->success($message, 200);
    }

    protected function success($message, $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message
        ], $code);
    }

}
