<?php namespace App\Repositories;

use App\Models\Contact;
use App\Interfaces\Repositories\ContactRepository as IContactRepository;

class ContactRepository extends RequestRepository implements IContactRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->setModelClass(Contact::class);
    }
}