<?php

namespace App\Enums;

enum AustralianState: string
{
    case ACT = 'ACT';
    case NSW = 'NSW';
    case NT = 'NT';
    case QLD = 'QLD';
    case SA = 'SA';
    case TAS = 'TAS';
    case VIC = 'VIC';
    case WA = 'WA';

    public static function labels(): array
    {
        return [
            'ACT' => 'ACT',
            'NSW' => 'New South Wales',
            'NT' => 'Northern Territory',
            'QLD' => 'Queensland',
            'SA' => 'South Australia',
            'TAS' => 'Tasmania',
            'VIC' => 'Victoria',
            'WA' => 'Western Australia',
        ];
    }
}
