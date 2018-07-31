<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    use GlobalRepositoryTrait;

    /**
     * @param array $criteria
     * @return array
     */
    public function findOneGloballyBy(array $criteria)
    {
        return $this->findOneGlobally($criteria, User::class);
    }
}