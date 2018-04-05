<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\UseRequestRepository;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Interfaces\Repositories\LeadRepository;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Methods to work with leads
 * @package App\Http\Controllers
 */
class LeadController extends Controller
{
    use UseRequestRepository;

    public function __construct(LeadRepository $repository)
    {
        $this->setRequestRepository($repository);
    }

    /**
     * Create request
     *
     * @param Request $request
     *
     * @return Response
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
     * Create validator
     *
     * @param array $data
     *
     * @return Validator
     */
    public function getValidator(array $data): Validator
    {
        $validator = ValidatorFacade::make($data, [
            'title'   => 'required',
            'name'    => 'required',
            'email.*' => 'required_without:phone|email',
            'phone'   => 'required_without:email|array',
        ]);


        return $validator;
    }
}