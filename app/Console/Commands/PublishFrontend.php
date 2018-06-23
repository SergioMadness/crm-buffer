<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Interfaces\Services\PublishService;

class PublishFrontend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish:frontend';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish frontend';

    /**
     * Execute the console command.
     *
     * @param PublishService $publishService
     *
     * @return mixed
     */
    public function handle(PublishService $publishService)
    {
        $publishService->publish();

        return true;
    }
}