<?php

declare(strict_types=1);

namespace Enmaboya\StrictnessForLaravel;

use Illuminate\Support\ServiceProvider;

class StrictnessForLaravelServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->alias('config', 'strict_config');
    }

    public function boot(): void
    {
        //
    }
}
