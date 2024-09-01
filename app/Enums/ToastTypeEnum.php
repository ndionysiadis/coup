<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self success()
 * @method static self error()
 * @method static self warning()
 * @method static self info()
 * @method static self default()
 */
final class ToastTypeEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'success' => 'SUCCESS',
            'error' => 'ERROR',
            'warning' => 'WARNING',
            'info' => 'INFO',
            'default' => 'DEFAULT',
        ];
    }
}
