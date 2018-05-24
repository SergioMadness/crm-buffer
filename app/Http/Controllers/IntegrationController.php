<?php namespace App\Http\Controllers;

use App\Interfaces\Model;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use App\Traits\UseIntegrationRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Interfaces\Repositories\IntegrationRepository;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Controller to work with integrations
 * @package App\Http\Controllers
 */
class IntegrationController extends Controller
{
    use UseIntegrationRepository;

    public function __construct(IntegrationRepository $repository)
    {
        $this->setIntegrationRepository($repository);
    }

    /**
     * Get integrations list
     *
     * @param Request $request
     *
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function index(Request $request): Response
    {
        $limit = min(self::LIST_LIMIT_MAX, $request->get('limit', self::LIST_LIMIT));
        $offset = max(0, $request->get('offset', 0));

        $repository = $this->getIntegrationRepository();
        $cnt = $repository->count();
        $data = $cnt > 0 ? $repository->get([], ['created_at' => 'desc'], $limit, $offset) : collect([]);

        return $this->listResponse($data, $cnt, $limit, $offset);
    }

    /**
     * Get model by id
     *
     * @param string $id
     *
     * @return Response
     * @throws \InvalidArgumentException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function view(string $id): Response
    {
        return $this->response(
            $this->getModel($id)
        );
    }

    /**
     * Create or update integration
     *
     * @param Request     $request
     * @param string|null $id
     *
     * @return Response
     * @throws \Exception
     */
    public function store(Request $request, $id = null): Response
    {
        $data = $request->all();

        if ($id !== null) {
            $model = $this->getModel($id);
        } else {
            $model = $this->getIntegrationRepository()->create();
        }

        $validator = $this->getValidator($data);
        if ($validator->fails()) {
            throw new BadRequestHttpException($validator->errors()->first());
        }

        if (!$this->getIntegrationRepository()->fill($model, $data)->save()) {
            throw new \Exception('Невозможно сохранить настройки');
        }

        return $this->response($model, [], $id === null ? self::STATUS_CREATED : self::STATUS_OK);
    }

    /**
     * Delete request
     *
     * @param $id
     *
     * @return Response
     * @throws \InvalidArgumentException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function destroy($id): Response
    {
        $this->getIntegrationRepository()->remove(
            $this->getModel($id)
        );

        return $this->response(null, [], self::STATUS_NO_CONTENT);
    }

    /**
     * Create validator
     *
     * @param array $data
     *
     * @return Validator
     */
    public function getValidator(array $data): Validator
    {
        $validator = ValidatorFacade::make($data, [
            'name'   => 'required',
            'driver' => 'required',
        ]);


        return $validator;
    }

    /**
     * Get model by id
     *
     * @param int|string $id
     *
     * @return Model
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    protected function getModel($id): Model
    {
        $model = $this->getIntegrationRepository()->model($id);

        if ($model === null) {
            throw new NotFoundHttpException();
        }

        return $model;
    }
}