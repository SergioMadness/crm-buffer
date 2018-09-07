<?php namespace App\Subsystems\IntegrationHub\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Subsystems\IntegrationHub\Traits\UseRequestRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Subsystems\IntegrationHub\Interfaces\Repositories\RequestRepository;

/**
 * Controller to work with events/requests
 * @package App\Subsystems\IntegrationHub\Http\Controllers
 */
class EventController extends Controller
{
    use UseRequestRepository;

    public function __construct(RequestRepository $repository)
    {
        $this->setRequestRepository($repository);
    }

    /**
     * Store event
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request): Response
    {
        $data = $request->all();
        $validator = $this->getValidator($data);
        if ($validator->fails()) {
            throw new BadRequestHttpException($validator->errors()->first());
        }

        $model = $this->getRequestRepository()->create([
            'application_id' => $request->attributes->get('application')->id,
            'body'           => $data,
        ]);
        $this->getRequestRepository()->save($model);

        return $this->response($model);
    }

    /**
     * Create validator
     *
     * @param array $data
     *
     * @return Validator
     */
    protected function getValidator(array $data): Validator
    {
        $validator = \Validator::make($data, [
            'data' => 'required|array',
        ]);

        return $validator;
    }
}