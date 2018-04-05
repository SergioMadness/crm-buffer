<?php namespace App\Console\Commands;

use App\Models\Request;
use App\Events\NewLeadPack;
use Illuminate\Console\Command;
use App\Interfaces\Repositories\RequestRepository;

class SendPack extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'requests:pack';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send pack';

    /**
     * Execute the console command.
     *
     * @param RequestRepository $requestRepository
     *
     * @return mixed
     */
    public function handle(RequestRepository $requestRepository)
    {
        $requestPack = $requestRepository->getPack(config('systems.packSize'));

        $requestPack->each(function (Request $model) use ($requestRepository) {
            $model->status = Request::STATUS_QUEUE;
            $requestRepository->save($model);
        });

        if ($requestPack->isNotEmpty()) {
            event(new NewLeadPack($requestPack->all()));
        }

        return true;
    }
}