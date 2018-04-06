<?php namespace App\Repositories;

use App\Models\Request;
use Illuminate\Support\Collection;
use App\Interfaces\Repositories\RequestRepository as IRequestRepository;

/**
 * Repository of requests
 * @package App\Repositories
 */
class RequestRepository extends BaseRepository implements IRequestRepository
{
    protected static $availableSystems = [];

    public function __construct()
    {
        $this->setModelClass(Request::class);
    }

    /**
     * Set list of available systems
     *
     * @param array $systems
     */
    public static function setAvailableSystems(array $systems): void
    {
        self::$availableSystems = $systems;
    }

    /**
     * Register system
     *
     * @param string $system
     */
    public static function registerSystem(string $system): void
    {
        self::$availableSystems[] = $system;
    }

    /**
     * Get pack of requests
     *
     * @param int $size
     *
     * @return Collection
     */
    public function getPack(int $size = 10): Collection
    {
        return Request::query()->whereIn('status', [Request::STATUS_NEW, Request::STATUS_RETRY])
            ->orderBy('created_at', 'asc')
            ->limit($size)
            ->get();
    }

    /**
     * Set request status
     *
     * @param string $id
     * @param string $status
     * @param string $message
     * @param string $system
     *
     * @return bool
     */
    public function setStatus(string $id, string $status, string $message = '', string $system = ''): bool
    {
        /** @var Request $request */
        $request = Request::find($id);
        $request->setSystemStatus($system, $status);
        if (empty($request->getSystemsNeedToBeProcessed(self::$availableSystems))) {
            $request->status = Request::STATUS_SUCCESS;
        }
        if ($status === Request::STATUS_RETRY) {
            $request->status = Request::STATUS_RETRY;
        }
        $request->response = $message;
        $request->incAttempts();

        return $request->save();
    }
}