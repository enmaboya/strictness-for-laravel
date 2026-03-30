<?php

declare(strict_types=1);

namespace Enmaboya\StrictnessForLaravel\Support;

use Illuminate\Support\Env;

class StrictEnv extends Env
{
    /**
     * Get the value of an environment variable.
     *
     * When $strict is true, the value is cast when present: numeric with decimal/exponent → float,
     * other numeric → int, boolean-like → bool.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public static function get($key, $default = null, bool $strict = false)
    {
        $option = self::getOption($key);

        if ($option->isEmpty()) {
            return value($default);
        }

        $result = $option->get();

        if ($strict) {
            if (is_bool($result)) {
                return $result;
            }

            if (is_numeric($result)) {
                if (str_contains($result, '.') || str_contains(strtolower($result), 'e')) {
                    return (float) $result;
                }

                return (int) $result;
            }

            if (in_array(strtolower($result), ['true', 'false', 'on', 'off', 'yes', 'no'], true)) {
                return filter_var($result, FILTER_VALIDATE_BOOLEAN);
            }
        }

        return $result;
    }
}
