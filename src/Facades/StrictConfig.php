<?php

declare(strict_types=1);

namespace Enmaboya\StrictnessForLaravel\Facades;

use Enmaboya\StrictnessForLaravel\Config\StrictConfigRepository;
use Illuminate\Support\Facades\Facade;

/**
 * @mixin StrictConfigRepository
 */
class StrictConfig extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'config';
    }
}
