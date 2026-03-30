<?php

declare(strict_types=1);

namespace Enmaboya\StrictnessForLaravel\Config;

use Enmaboya\StrictnessForLaravel\Enums\IntType;
use Enmaboya\StrictnessForLaravel\Enums\StringType;
use Illuminate\Config\Repository as BaseRepository;
use Illuminate\Contracts\Config\Repository as ConfigContract;
use InvalidArgumentException;

class StrictConfigRepository extends BaseRepository implements ConfigContract
{
    /**
     * Get the specified string configuration value with optional type validation.
     *
     * @param  (\Closure():(string|null))|string|null  $default
     * @return (
     *     $type is StringType::DEFAULT ? string :
     *     ($type is StringType::NON_EMPTY ? non-empty-string :
     *     ($type is StringType::NON_FALSY ? non-falsy-string :
     *     ($type is StringType::LOWERCASE ? lowercase-string : uppercase-string)))
     * )
     *
     * @throws InvalidArgumentException
     */
    public function string(string $key, $default = null, StringType $type = StringType::DEFAULT): string
    {
        $value = $this->get($key, $default);

        if (! is_string($value)) {
            throw new InvalidArgumentException(
                sprintf('Configuration value for key [%s] must be a string, %s given.', $key, gettype($value))
            );
        }

        if ($type === StringType::NON_EMPTY) {
            if (trim($value) === '') {
                throw new InvalidArgumentException(
                    sprintf('Configuration value for key [%s] must be a non-empty string, %s given.', $key, $value)
                );
            }

            return $value;
        }

        if ($type === StringType::NON_FALSY) {
            if (! (bool) $value) {
                throw new InvalidArgumentException(
                    sprintf('Configuration value for key [%s] must be a non-falsy string, %s given.', $key, $value)
                );
            }

            return $value;
        }

        if ($type === StringType::LOWERCASE) {
            if (strtolower($value) !== $value) {
                throw new InvalidArgumentException(
                    sprintf('Configuration value for key [%s] must be a lowercase string, %s given.', $key, $value)
                );
            }

            return $value;
        }

        if ($type === StringType::UPPERCASE) {
            if (strtoupper($value) !== $value) {
                throw new InvalidArgumentException(
                    sprintf('Configuration value for key [%s] must be an uppercase string, %s given.', $key, $value)
                );
            }

            return $value;
        }

        return $value;
    }

    /**
     * Get the specified integer configuration value with optional type validation.
     *
     * @param  (\Closure():(int|null))|int|null  $default
     * @return (
     *     $type is IntType::DEFAULT ? int :
     *     ($type is IntType::POSITIVE ? positive-int :
     *     ($type is IntType::NEGATIVE ? negative-int :
     *     ($type is IntType::NON_POSITIVE ? non-positive-int :
     *     ($type is IntType::NON_NEGATIVE ? non-negative-int : non-zero-int))))
     * )
     *
     * @throws InvalidArgumentException
     */
    public function integer(string $key, $default = null, IntType $type = IntType::DEFAULT): int
    {
        $value = $this->get($key, $default);

        if (! is_int($value)) {
            throw new InvalidArgumentException(
                sprintf('Configuration value for key [%s] must be an integer, %s given.', $key, gettype($value))
            );
        }

        if ($type === IntType::POSITIVE) {
            if ($value <= 0) {
                throw new InvalidArgumentException(
                    sprintf('Configuration value for key [%s] must be a positive integer, %s given.', $key, $value)
                );
            }

            return $value;
        }

        if ($type === IntType::NEGATIVE) {
            if ($value >= 0) {
                throw new InvalidArgumentException(
                    sprintf('Configuration value for key [%s] must be a negative integer, %s given.', $key, $value)
                );
            }

            return $value;
        }

        if ($type === IntType::NON_POSITIVE) {
            if ($value > 0) {
                throw new InvalidArgumentException(
                    sprintf('Configuration value for key [%s] must be a non-positive integer, %s given.', $key, $value)
                );
            }

            return $value;
        }

        if ($type === IntType::NON_NEGATIVE) {
            if ($value < 0) {
                throw new InvalidArgumentException(
                    sprintf('Configuration value for key [%s] must be a non-negative integer, %s given.', $key, $value)
                );
            }

            return $value;
        }

        if ($type === IntType::NON_ZERO) {
            if ($value === 0) {
                throw new InvalidArgumentException(
                    sprintf('Configuration value for key [%s] must be a non-zero integer, %s given.', $key, $value)
                );
            }

            return $value;
        }

        return $value;
    }
}
