<?php namespace App\Subsystems\Supervisor\Service;

use App\Subsystems\IntegrationHubDB\Models\Request;
use App\Subsystems\IntegrationHubDB\Traits\UseFlowRepository;
use App\Subsystems\IntegrationHubDB\Interfaces\Models\ProcessOptions;
use App\Subsystems\IntegrationHubDB\Traits\UseProcessOptionsRepository;
use App\Subsystems\IntegrationHubDB\Interfaces\Repositories\FlowRepository;
use App\Subsystems\Supervisor\Interfaces\Services\Supervisor as ISupervisor;
use App\Subsystems\Supervisor\Exceptions\WrongProcessPathException;
use App\Subsystems\IntegrationHubDB\Interfaces\Repositories\ProcessOptionsRepository;

/**
 * Service that resolve next step of processing
 * @package App\Subsystems\Supervisor\Service
 */
class Supervisor implements ISupervisor
{
    use UseFlowRepository, UseProcessOptionsRepository;

    public function __construct(FlowRepository $flowRepository, ProcessOptionsRepository $processOptionsRepository)
    {
        $this->setFlowRepository($flowRepository)
            ->setProcessOptionsRepository($processOptionsRepository);
    }

    /**
     * Add/update event
     *
     * @param Request $request
     *
     * @return null|ProcessOptions
     * @throws \Exception
     */
    public function nextProcess(Request $request): ?ProcessOptions
    {
        $flowRepository = $this->getFlowRepository();
        $currentFlow = $request->getCurrentFlow();
        if (empty($currentFlow)) {
            $flow = $flowRepository->getDefault();
        } else {
            $flow = $flowRepository->model($currentFlow);
        }
        if ($flow === null) {
            throw new WrongProcessPathException();
        }
        $processOptions = null;
        if (($nextStep = $flow->getNext($request->getCurrentStep())) !== null) {
            $processOptions = $this->getProcessOptionsRepository()->model($nextStep);
        }

        return $processOptions;
    }
}