<?php

namespace App\DataFixtures\Faker\Provider;

use Doctrine\Common\Collections\ArrayCollection;
use Faker\Generator;
use Faker\Provider\Base;

class ArrayCollectionProvider extends Base
{
    public function __construct()
    {
        parent::__construct(new Generator());
    }

    /**
     * @param array $values
     * @return ArrayCollection
     */
    public static function arrayCollection(array $values)
    {
        return new ArrayCollection($values);
    }
}
