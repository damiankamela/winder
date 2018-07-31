<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmployeeRepository")
 */
class Employee extends User
{
    public function getRoles()
    {
        return ['ROLE_EMPLOYEE'];
    }
}