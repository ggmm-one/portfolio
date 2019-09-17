<?php

class Person extends Faker\Provider\en_US\Person
{
    private $lastNameIssued = null;

    public function name($gender = null)
    {
        $this->lastNameIssued = $this->generator->firstName($gender).' '.$this->generator->lastName($gender);
        return $this->lastNameIssued;
    }

    public function safeEmail() {
        $username = $this->lastNameIssued ?? $this->name();
        $username = str_replace(' ', '.', strtolower($username));
        return $username.'@example.org';
    }
}
