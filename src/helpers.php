<?php

declare(strict_types=1);

use Enmaboya\StrictnessForLaravel\Config\StrictConfigRepository;
use Enmaboya\StrictnessForLaravel\Support\StrictEnv;

if (! function_exists('strict_config')) {
    /**
     * @return StrictConfigRepository
     */
    function strict_config()
    {
        return app(StrictConfigRepository::class);
    }
}

if (! function_exists('strict_env')) {
    /**
     * Gets the value of an environment variable.
     *
     * When $strict is true, the value is cast when present: numeric with decimal/exponent → float,
     * other numeric → int, boolean-like → bool.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    function strict_env($key, $default = null, bool $strict = true)
    {
        return StrictEnv::get($key, $default, $strict);
    }
}
