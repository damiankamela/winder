<?php

namespace App\Repository;

trait GlobalRepositoryTrait
{
    /**
     * @param array $criteria
     * @param       $entity
     * @return array
     */
    protected function findOneGlobally(array $criteria, $entity)
    {
        $keys = array_keys($criteria);

        $column = $keys[0];
        $value = $criteria[$keys[0]];

        return
            $this
                ->getEntityManager()
                ->createQuery("SELECT u FROM {$entity} u WHERE u.{$column} = ?1")
                ->setParameter(1, $value)
                ->getResult();
    }
}