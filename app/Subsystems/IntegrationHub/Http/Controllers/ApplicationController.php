<?php namespace App\Subsystems\IntegrationHub\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Subsystems\IntegrationHub\Interfaces\Model;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Subsystems\IntegrationHub\Traits\UseApplicationRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Subsystems\IntegrationHub\Interfaces\Repositories\ApplicationRepository;

/**
 * Controller to work with applications
 * @package App\Http\Controllers
 */
class ApplicationController extends Controller
{
    use UseApplicationRepository;

    public function __construct(ApplicationRepository $applicationRepository)
    {
        $this->setApplicationRepository($applicationRepository);
    }

    /**
     * Get application list
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        $limit = min(self::LIST_LIMIT_MAX, $request->get('limit', self::LIST_LIMIT));
        $offset = max(0, $request->get('offset', 0));

        $data = $this->getApplicationRepository()->get([], [], $limit, $offset);

        return $this->response($data);
    }

    /**
     * Create or update application
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
            $model = $this->getApplicationRepository()->create();
        }

        $validator = $this->getValidator($data);
        if ($validator->fails()) {
            throw new BadRequestHttpException($validator->errors()->first());
        }

        if (!$this->getApplicationRepository()->fill($model, $data)->save()) {
            throw new \Exception('Невозможно сохранить приложение');
        }

        return $this->response($model, [], $id === null ? self::STATUS_CREATED : self::STATUS_OK);
    }

    /**
     * Set new keys
     *
     * @param $id
     *
     * @return Response
     */
    public function regenerateTokens($id): Response
    {
        $model = $this->getModel($id);

        $this->getApplicationRepository()->generateKeys($model);

        return $this->response($model);
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
     * Delete model
     *
     * @param string $id
     *
     * @return Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function destroy(string $id): Response
    {
        $this->getModel($id)->delete();

        return $this->response(null, [], self::STATUS_NO_CONTENT);
    }

    /**
     * Get validator
     *
     * @param array $data
     *
     * @return Validator
     */
    protected function getValidator(array $data): Validator
    {
        $validator = ValidatorFacade::make($data, [
            'name' => 'required',
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
        $model = $this->getApplicationRepository()->model($id);

        if ($model === null) {
            throw new NotFoundHttpException();
        }

        return $model;
    }
}