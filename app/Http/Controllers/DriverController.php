<?php namespace App\Http\Controllers;

use App\Interfaces\Services\IntegrationsPool;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller to get driver list
 * @package App\Http\Controllers
 */
class DriverController extends Controller
{
    /**
     * Get driver list
     *
     * @param IntegrationsPool $pool
     *
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function index(IntegrationsPool $pool): Response
    {
        return $this->response($pool->getDrivers());
    }
}