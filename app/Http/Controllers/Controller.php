<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public const LIST_LIMIT = 10;

    public const LIST_LIMIT_MAX = 150;

    public const STATUS_OK = 200;

    public const STATUS_NO_CONTENT = 204;

    public const STATUS_CREATED = 201;

    /**
     * Response
     *
     * @param mixed $data
     * @param int   $status
     * @param array $headers
     *
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function response($data, array $headers = [], int $status = self::STATUS_OK): Response
    {
        return \response()->json($data)->setStatusCode($status)->withHeaders($headers);
    }
}
