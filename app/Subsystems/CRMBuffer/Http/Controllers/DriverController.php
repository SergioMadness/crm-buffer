<?php namespace App\Subsystems\CRMBuffer\Http\Controllers;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Subsystems\CRMBuffer\Interfaces\DriverPool;

/**
 * Controller to get driver list
 * @package App\Http\Controllers
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