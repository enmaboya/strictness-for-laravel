<?php

declare(strict_types=1);

use Enmaboya\StrictnessForLaravel\Config\StrictConfigRepository;

if (! function_exists('strict_config')) {
    /**
     * @return StrictConfigRepository
     */
    function strict_config()
    {
        return app(StrictConfigRepository::class);
    }
}
