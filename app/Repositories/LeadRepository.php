<?php namespace App\Repositories;

use App\Models\Lead;
use App\Interfaces\Repositories\LeadRepository as ILeadRepository;

class LeadRepository extends RequestRepository implements ILeadRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->setModelClass(Lead::class);
    }
}