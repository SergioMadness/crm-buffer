<?php namespace App\Subsystems\CRMBuffer\Repositories;

use App\Subsystems\CRMBuffer\Models\Lead;
use App\Subsystems\CRMBuffer\Interfaces\Repositories\LeadRepository as ILeadRepository;

class LeadRepository extends RequestRepository implements ILeadRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->setModelClass(Lead::class);
    }
}