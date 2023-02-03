<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function error(array $data = [], int $status = 500)
    {
        return response()->json(
            [
                'status'  => false,
                'message' => $data
            ],
            $status
        );
    }

    /**
     * @param $data
     * @param $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($data, $status = 200)
    {
        return response()->json(['success'=> true, 'data' => $data], $status);
    }
}
