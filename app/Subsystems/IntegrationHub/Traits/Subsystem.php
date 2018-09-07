<?php namespace App\Subsystems\IntegrationHub\Traits;

trait Subsystem
{
    /**
     * @param string $pathToFile
     *
     * @return self
     */
    protected function loadRoutes(string $pathToFile): self
    {

        include $pathToFile;

        return $this;
    }
}