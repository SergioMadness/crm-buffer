<?php namespace App\Subsystems\CRMBuffer\Repositories;

use App\Subsystems\CRMBuffer\Models\Contact;
use App\Subsystems\CRMBuffer\Interfaces\Repositories\ContactRepository as IContactRepository;

class ContactRepository extends RequestRepository implements IContactRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->setModelClass(Contact::class);
    }
}