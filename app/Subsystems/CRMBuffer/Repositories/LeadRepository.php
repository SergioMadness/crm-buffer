<?php namespace professionalweb\IntegrationHub\Subsystems\CRMBuffer\Repositories;

use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Models\Lead;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Repositories\LeadRepository as ILeadRepository;

class LeadRepository extends RequestRepository implements ILeadRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->setModelClass(Lead::class);
    }
}