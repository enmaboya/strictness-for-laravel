<?php

declare(strict_types=1);

namespace Enmaboya\StrictnessForLaravel\Enums;

enum IntType: string
{
    case DEFAULT = 'default';
    case POSITIVE = 'positive';
    case NEGATIVE = 'negative';
    case NON_POSITIVE = 'nonPositive';
    case NON_NEGATIVE = 'nonNegative';
    case NON_ZERO = 'nonZero';
}
