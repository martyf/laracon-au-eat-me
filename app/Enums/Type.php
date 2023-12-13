<?php

namespace App\Enums;

enum Type: string
{
    case RING = 'RING';
    case FILLED = 'FILLED';

    public static function labels(): array
    {
        return [
            'FILLED' => 'Filled',
            'RING' => 'Ring',
        ];
    }
}
