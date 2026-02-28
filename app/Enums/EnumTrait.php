<?php

namespace App\Enums;

trait EnumTrait
{
    public static function values()
    {
        return array_column(self::cases(), 'value');
    }
}
