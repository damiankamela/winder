<?php

namespace App\DataFixtures\Faker\Provider;

use Faker\Generator;
use Faker\Provider\Base;

class DateTimeProvider extends Base
{
    public function __construct()
    {
        parent::__construct(new Generator());
    }

    /**
     * @param string $expression
     * @param int $hour
     * @param int $minutes
     * @param int $seconds
     * @param string $format
     * @return string
     */
    public static function dateTimeModify(string $expression, int $hour = 0, int $minutes = 0, int $seconds = 0, string $format = \DateTime::ISO8601)
    {
        $now = (new \DateTime('now'))->modify($expression);
        return $now->setTime($hour,$minutes,$seconds)->format($format);
    }
}
