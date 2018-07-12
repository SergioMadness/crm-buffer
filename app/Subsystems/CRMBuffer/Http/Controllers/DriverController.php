<?php namespace App\Subsystems\CRMBuffer\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Subsystems\CRMBuffer\Interfaces\IntegrationsPool;
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
     * @param \App\Subsystems\CRMBuffer\Interfaces\IntegrationsPool $pool
     *
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function index(IntegrationsPool $pool): Response
    {
        return $this->response($pool->getDrivers());
    }
}