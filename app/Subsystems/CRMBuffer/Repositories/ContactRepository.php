<?php namespace professionalweb\IntegrationHub\Subsystems\CRMBuffer\Repositories;

use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Models\Contact;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Repositories\ContactRepository as IContactRepository;

class ContactRepository extends RequestRepository implements IContactRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->setModelClass(Contact::class);
    }
}