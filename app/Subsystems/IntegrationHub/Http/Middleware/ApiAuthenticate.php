<?php

namespace App\Subsystems\IntegrationHub\Http\Middleware;

use Closure;
use App\Subsystems\IntegrationHub\Traits\UseApplicationRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use App\Subsystems\IntegrationHub\Interfaces\Services\RequestValidation;
use App\Subsystems\IntegrationHub\Interfaces\Repositories\ApplicationRepository;

/**
 * Middleware to validate request
 * @package App\Http\Middleware
 */
class ApiAuthenticate
{
    use UseApplicationRepository;

    public const PARAM_SIGNATURE = 'sig';

    public const PARAM_CLIENT_ID = 'token';

    /**
     * @var RequestValidation
     */
    private $requestValidationService;

    /**
     * Create a new middleware instance.
     *
     * @param ApplicationRepository $repository
     * @param RequestValidation     $requestValidationService
     */
    public function __construct(ApplicationRepository $repository, RequestValidation $requestValidationService)
    {
        $this->setApplicationRepository($repository)
            ->setRequestValidationService($requestValidationService);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     * @throws \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
     */
    public function handle($request, Closure $next)
    {
        $clientId = $request->get(self::PARAM_CLIENT_ID);
        $signature = $request->get(self::PARAM_SIGNATURE);

        if (empty($clientId) || empty($signature) || ($application = $this->getApplicationRepository()->getByClientId($clientId)) === null) {
            throw new UnauthorizedHttpException('');
        }

        if (!$this->getRequestValidationService()
            ->validate(
                $request->except(self::PARAM_SIGNATURE),
                $application->client_secret,
                $signature
            )
        ) {
            throw new BadRequestHttpException();
        }

        $request->replace($request->except([self::PARAM_CLIENT_ID, self::PARAM_SIGNATURE]));

        $request->attributes->set('application', $application);

        return $next($request);
    }

    /**
     * Get request validation service
     *
     * @return RequestValidation
     */
    public function getRequestValidationService(): RequestValidation
    {
        return $this->requestValidationService;
    }

    /**
     * Set request validation service
     *
     * @param RequestValidation $requestValidationService
     *
     * @return ApiAuthenticate
     */
    public function setRequestValidationService(RequestValidation $requestValidationService): self
    {
        $this->requestValidationService = $requestValidationService;

        return $this;
    }


}
