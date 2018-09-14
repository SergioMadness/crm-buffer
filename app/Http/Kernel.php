<?php

namespace professionalweb\IntegrationHub\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

/**
 * Class Kernel
 *
 * @package professionalweb\IntegrationHub\Http
 */
class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [

    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web'    => [

        ],
        'admin'  => [

        ],
        'common' => [],
        'api'    => [

        ],
    ];
}
