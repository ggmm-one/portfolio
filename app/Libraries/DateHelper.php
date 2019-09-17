<?php

namespace App\Libraries;

abstract class DateHelper
{
    public static function setDateToMonth(?string $month): ?string
    {
        if ($month == null || strlen($month) != 10) return null;
        $month[8] = '0';
        $month[9] = '1';
        return $month;
    }
}
