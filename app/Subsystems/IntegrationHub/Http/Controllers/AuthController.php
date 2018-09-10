<?php namespace App\Subsystems\IntegrationHub\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use App\Subsystems\IntegrationHubCommon\Constants\Request as IRequest;
use App\Subsystems\IntegrationHub\Interfaces\Repositories\UserRepository;

/**
 * Authorize
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * User authorization
     *
     * @param Request        $request
     * @param UserRepository $userRepository
     *
     * @return Response
     * @throws \InvalidArgumentException
     * @throws \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     */
    public function login(Request $request, UserRepository $userRepository): Response
    {
        $validator = $this->getValidator($request->all());
        if ($validator->fails()) {
            throw new BadRequestHttpException($validator->errors()->first());
        }

        $user = $userRepository->getByCredentials($request->get('login'), $request->get('password'));
        if ($user === null) {
            throw new UnauthorizedHttpException('', trans('authorization.wrong-credentials'));
        }

        $token = $user->generateToken();

        return $this->response($user, [
            IRequest::TOKEN_HEADER_NAME         => $token->getToken(),
            IRequest::REFRESH_TOKEN_HEADER_NAME => $token->getRefreshToken(),
        ]);
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
        $validator = ValidatorFacade::make($data, [
            'login'    => 'required',
            'password' => 'required',
        ]);

        return $validator;
    }
}