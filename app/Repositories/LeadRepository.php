<?php namespace App\Repositories;

use App\Interfaces\Repositories\LeadRepository as ILeadRepository;
use App\Models\Lead;

class LeadRepository extends RequestRepository implements ILeadRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->setModelClass(Lead::class);
    }
}