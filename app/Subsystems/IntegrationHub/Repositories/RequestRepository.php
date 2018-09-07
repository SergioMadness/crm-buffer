<?php namespace App\Subsystems\IntegrationHub\Repositories;

//use Illuminate\Support\Collection;
use App\Subsystems\IntegrationHub\Models\Request;
use App\Subsystems\IntegrationHub\Interfaces\Model;
use App\Subsystems\IntegrationHub\Interfaces\Repositories\RequestRepository as IRequestRepository;

/**
 * Repository of requests
 * @package App\Subsystems\Supervisor\Repositories
 */
class RequestRepository extends BaseRepository implements IRequestRepository
{
//    protected static $availableSystems = [];

    public function __construct()
    {
        $this->setModelClass(Request::class);
    }

    /**
     * Create model; Set default type
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes = []): Model
    {
        if (!isset($attributes['request_type'])) {
            $attributes['request_type'] = Request::DEFAULT_TYPE;
        }

        return parent::create($attributes);
    }

//    /**
//     * Set list of available systems
//     *
//     * @param array $systems
//     */
//    public static function setAvailableSystems(array $systems): void
//    {
//        self::$availableSystems = $systems;
//    }
//
//    /**
//     * Register system
//     *
//     * @param string $system
//     */
//    public static function registerSystem(string $system): void
//    {
//        self::$availableSystems[] = $system;
//    }

//    /**
//     * Get pack of requests
//     *
//     * @param int $size
//     *
//     * @return Collection
//     */
//    public function getPack(int $size = 10): Collection
//    {
//        return Request::query()->whereIn('status', [Request::STATUS_NEW, Request::STATUS_RETRY])
//            ->orderBy('created_at', 'asc')
//            ->limit($size)
//            ->get();
//    }
//
//    /**
//     * Set request status
//     *
//     * @param string $id
//     * @param string $status
//     * @param mixed  $message
//     * @param string $system
//     *
//     * @return bool
//     */
//    public function setStatus(string $id, string $status, $message = '', string $system = ''): bool
//    {
//        /** @var \App\Models\Request $request */
//        $request = Request::find($id);
//        $request->setSystemStatus($system, $status);
//        $request->status = Request::STATUS_RETRY;
//        if (empty($request->getSystemsNeedToBeProcessed(self::$availableSystems))) {
//            $request->status = $status;
//        }
//        $response = $request->response;
//        $response[$system] = $message;
//        $request->response = $response;
//        $request->incAttempts();
//
//        return $request->save();
//    }
}