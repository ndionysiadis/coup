<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self topLeft()
 * @method static self topCenter()
 * @method static self topRight()
 * @method static self bottomLeft()
 * @method static self bottomCenter()
 * @method static self bottomRight()
 */
final class ToastPositionEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'topLeft' => 'TOP_LEFT',
            'topCenter' => 'TOP_CENTER',
            'topRight' => 'TOP_RIGHT',
            'bottomLeft' => 'BOTTOM_LEFT',
            'bottomCenter' => 'BOTTOM_CENTER',
            'bottomRight' => 'BOTTOM_RIGHT',
        ];
    }
}
