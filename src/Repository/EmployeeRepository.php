<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Employee;

class EmployeeRepository extends UserRepository
{
    /**
     * @param array $criteria
     * @return array
     */
    public function findOneGloballyBy(array $criteria)
    {
        return $this->findOneGlobally($criteria, Employee::class);
    }
}