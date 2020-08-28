<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;

class Users extends Model
{
    public $id;
    public $first_name;
    public $last_name;
    public $age;
    public $phone;
    public $address;
    public $driver_license;
    public $password;

    public function validation()
    {
        // TODO validation
    }


    public function getFullName() {
        return $this->first_name . " " .$this->last_name;
    }

}