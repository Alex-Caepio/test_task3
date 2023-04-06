<?php

require_once 'DbJsonCrud.php';
require_once 'Validator.php';

class BaseController
{
    public Validator $validator;
    public DbJsonCrud $dbJsonCrud;

    public function __construct()
    {
        $this->validator = new Validator();
        $this->dbJsonCrud = new DbJsonCrud('../Database/db.json');
    }
}
