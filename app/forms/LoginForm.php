<?php

use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class LoginForm extends Form
{
    public function initialize()
    {
        // License
        $field = new Text(
            'driver_license',
            [
                'class' => "form-control",
                'placeholder' => "Driver license",
            ]
        );
        $field->setLabel("Driver license");
        $field->addValidator(
            new PresenceOf(
                [
                    'message' => 'Field is required',
                ]
            )
        );
        $field->addValidator(
            new Phalcon\Validation\Validator\Regex(
                [
                    "pattern" => "/^[A-Za-z][0-9]{4}-[0-9]{5}-[0-9]{5}$/",
                    "message" => "Wrong driver license format, must be LXXXX-FFFMY-YMMDD",
                ]
            )
        );
        $this->add($field);

        // Password
        $field = new Password(
            'password',
            [
                'class' => "form-control",
                'placeholder' => "Password"
            ]
        );
        $field->setLabel("Password");
        $field->addValidator(
            new StringLength(
                [
                    "max" => 50,
                    "min" => 3,
                    "messageMaximum" => "Password length must be between 3 and 50",
                ]
            )
        );

        $this->add($field);
    }
}