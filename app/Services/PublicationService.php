<?php namespace App\Services;

use Illuminate\Support\Facades\File;
use App\Interfaces\Services\PublishService;

/**
 * Service to publish resources
 * @package App\Services
 */
class PublicationService implements PublishService
{
    private $resources = [];

    /**
     * Register resource
     *
     * @param string $subsystemAlias
     * @param string $dirToPublish
     *
     * @return $this
     */
    public function register(string $subsystemAlias, string $dirToPublish): PublishService
    {
        if (!isset($this->resources[$subsystemAlias])) {
            $this->resources[$subsystemAlias] = [];
        }

        $this->resources[$subsystemAlias][] = $dirToPublish;

        return $this;
    }

    /**
     * Publish all resources
     */
    public function publish(): void
    {
        foreach ($this->resources as $alias => $path) {
            $dir = 'public/' . $alias;
            File::makeDirectory($dir);
            File::copyDirectory($path, $dir);
        }
    }
}