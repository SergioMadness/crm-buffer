<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class PublishVendor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vendor:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish resources';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $paths = ServiceProvider::pathsToPublish();

        foreach ($paths as $from => $to) {
            if (File::isFile($from)) {
                File::copy($from, $to);
            } else {
                File::copyDirectory($from, $to);
            }
        }

        return true;
    }
}