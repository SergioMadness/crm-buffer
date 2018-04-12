<?php namespace App\Http\Controllers;

use App\Interfaces\Model;
use Illuminate\Http\Request;
use App\Traits\UseRequestRepository;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Interfaces\Repositories\ContactRepository;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Methods to work with contacts
 * @package App\Http\Controllers
 */
class ContactController extends Controller
{
    use UseRequestRepository;

    public function __construct(ContactRepository $repository)
    {
        $this->setRequestRepository($repository);
    }

    /**
     * Get lead list
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

        $repository = $this->getRequestRepository();
        $cnt = $repository->count();
        $data = $cnt > 0 ? $repository->get([], [], $limit, $offset) : collect([]);

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
     * Create request
     *
     * @param Request $request
     *
     * @return Response
     * @throws \InvalidArgumentException
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     */
    public function store(Request $request): Response
    {
        $data = $request->all();
        if (isset($data['email'])) {
            $data['email'] = (array)$data['email'];
        }
        if (isset($data['phone'])) {
            $data['phone'] = (array)$data['phone'];
        }
        $validator = $this->getValidator($data);
        if ($validator->fails()) {
            throw new BadRequestHttpException($validator->errors()->first());
        }
        $repository = $this->getRequestRepository();
        $model = $repository->create([
            'application_id' => $request->attributes->get('application')->id,
            'body'           => $request->all(),
        ]);
        $repository->save($model);

//        event(new NewLead($model->id, $model->body));

        return $this->response($model);
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
        $this->getRequestRepository()->remove(
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
            'name'        => 'required',
            'last_name'   => 'required',
            'second_name' => 'required',
            'email.*'     => 'required_without:phone|email',
            'phone'       => 'required_without:email|array',
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
        $model = $this->getRequestRepository()->model($id);

        if ($model === null) {
            throw new NotFoundHttpException();
        }

        return $model;
    }
}