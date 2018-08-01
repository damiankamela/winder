<?php

namespace App\DataFixtures\Faker\Provider;

use Faker\Generator;
use Faker\Provider\Base;

class ConstantProvider extends Base
{
    public function __construct()
    {
        parent::__construct(new Generator());
    }

    /**
     * @param $constant
     * @return mixed
     */
    public static function constant($constant)
    {
        return constant($constant);
    }
}
