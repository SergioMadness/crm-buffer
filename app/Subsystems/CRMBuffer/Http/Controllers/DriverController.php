<?php namespace professionalweb\IntegrationHub\Subsystems\CRMBuffer\Http\Controllers;

use professionalweb\IntegrationHub\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\DriverPool;

/**
 * Controller to get driver list
 * @package professionalweb\IntegrationHub\Http\Controllers
 */
class DriverController extends Controller
{
    /**
     * Get driver list
     *
     * @param DriverPool $pool
     *
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function index(DriverPool $pool): Response
    {
        return $this->response($pool->getDrivers());
    }
}