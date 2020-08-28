<?php

use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Uniqueness;

class SignupForm extends Form
{
    public function initialize()
    {
        // First name
        $field = new Text(
            'first_name',
            [
                'class' => "form-control",
                'placeholder' => "First name"
            ]
        );
        $field->setLabel("First name");
        $field->addValidator(
            new PresenceOf(
                [
                    'message' => 'Field is required',
                ]
            )
        );
        $field->addValidator(
            new StringLength(
                [
                    "max" => 50,
                    "min" => 2,
                    "messageMaximum" => "First name must be no more than 50 characters",
                    "messageMinimum" => "First name must be at least 2 characters",
                ]
            )
        );
        $this->add($field);

        // Last name
        $field = new Text(
            'last_name',
            [
                'class' => "form-control",
                'placeholder' => "Last name"
            ]
        );
        $field->setLabel("Last name");
        $field->addValidator(
            new PresenceOf(
                [
                    'message' => 'Field is required',
                ]
            )
        );
        $field->addValidator(
            new StringLength(
                [
                    "max" => 50,
                    "min" => 2,
                    "messageMaximum" => "Last name must be no more than 50 characters",
                    "messageMinimum" => "Last name must be at least 2 characters",
                ]
            )
        );
        $this->add($field);


        // Age
        $field = new Numeric(
            'age',
            [
                'class' => "form-control",
                'placeholder' => "Age"
            ]
        );
        $field->setLabel("Age");
        $field->addValidator(
            new Phalcon\Validation\Validator\Digit(
                [
                    "message" => "Age must be numeric",
                ]
            )
        );
        $field->addValidator(
            new PresenceOf(
                [
                    'message' => 'Field is required',
                ]
            )
        );
        $field->addValidator(
            new Between(
                [
                    "minimum" => 0,
                    "maximum" => 99,
                    "message" => "Age must be between 0 and 99",
                ]
            )
        );
        $this->add($field);

        // Phone
        $field = new Text(
            'phone',
            [
                'class' => "form-control",
                'placeholder' => "Phone",
            ]
        );
        $field->setLabel("Phone");
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
                    "pattern" => "/^\+1[0-9]{3}-[0-9]{3}-[0-9]{4}$/",
                    "message" => "Wrong phone format, must be +1NPA-NXX-XXXX",
                ]
            )
        );
        $this->add($field);

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
        $field->addValidator(
            new Uniqueness(
                [
                    "model"   => new Users(),
                    "message" => "This driver license already registered",
                ]
            )
        );
        $this->add($field);


        // Address
        $field = new Text(
            'address',
            [
                'class' => "form-control",
                'placeholder' => "Address",
            ]
        );
        $field->setLabel("Address");
        $field->addValidator(
            new StringLength(
                [
                    "max" => 10000,
                    "min" => 0,
                    "messageMaximum" => "You live too far",
                ]
            )
        );
        $this->add($field);



        // Password
        $newPassword = new Password(
            'password',
            [
                'class' => "form-control",
                'placeholder' => "Password"
            ]
        );
        $newPassword->setLabel("Password");
        $newPassword->addValidator(
            new StringLength(
                [
                    "max" => 50,
                    "min" => 3,
                    "messageMaximum" => "Password length must be between 3 and 50",
                ]
            )
        );
        $newPassword->addValidator(
            new PresenceOf(
                [
                    'message' => 'Field is required',
                ]
            )
        );
        $this->add($newPassword);

        // Repeat password
        $repeatPassword = new Password(
            'repeat-password',
            [
                'class' => "form-control",
                'placeholder' => "Repeat password"
            ]
        );
        $repeatPassword->setLabel("Repeat password");
        $repeatPassword->addValidator(
            new StringLength(
                [
                    "max" => 50,
                    "min" => 3,
                    "messageMaximum" => "Password length must be between 3 and 50",
                ]
            )
        );
        $repeatPassword->addValidator(
            new PresenceOf(
                [
                    'message' => 'Field is required',
                ]
            )
        );
        $repeatPassword->addValidator(new Identical([
                'value' =>  $newPassword->getValue(),
                'message' => 'Passwords must match'
            ])
        );
        $this->add($repeatPassword);
    }
}