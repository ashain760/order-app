<?php


namespace App\Traits;


trait ApiResponseTrait
{
    /**
     * @param string $message
     * @param null $data
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function response($message = '', $statusCode = 500, $data = null)
    {
        $response = [
            'code' => $statusCode,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $statusCode);
    }
}
