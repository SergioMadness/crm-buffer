<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    const STATUS_OK = 200;

    /**
     * Response
     *
     * @param mixed $data
     * @param int   $status
     *
     * @return Response
     */
    public function response($data, int $status = self::STATUS_OK): Response
    {
        return \response()->json($data)->setStatusCode($status);
    }
}
