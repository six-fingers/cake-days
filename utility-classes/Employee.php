<?php

namespace UtilityClass;

use DateTime;

class Employee
{
    private $name;
    private $dob;

    public function __construct(string $name, string $dob)
    {
        $this->name = $name;
        $this->dob = new DateTime($dob);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDob(): DateTime
    {
        return $this->dob;
    }
}
