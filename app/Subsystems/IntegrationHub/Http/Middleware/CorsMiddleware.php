<?php namespace App\Subsystems\IntegrationHub\Http\Middleware;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Router;

class CorsMiddleware
{
    /**
     * @param Request  $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if ($request->isMethod('OPTIONS')) {
            app(Router::class)->options($request->path(), function () {
                return response('', 200);
            });
        }

        $response = $next($request);
        $response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE');
        $response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers', '*'));
        $response->header('Access-Control-Allow-Origin', '*');
        $response->header('access-control-expose-headers', '*');

        return $response;
    }
}