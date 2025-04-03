<?php

declare(strict_types=1);

namespace Laminas\Validator\Barcode;

use function in_array;
use function is_numeric;
use function strlen;

final class Planet implements AdapterInterface
{
    private const LENGTH = [12, 14];

    public function hasValidLength(string $value): bool
    {
        return in_array(strlen($value), self::LENGTH, true);
    }

    public function hasValidCharacters(string $value): bool
    {
        return is_numeric($value);
    }

    public function hasValidChecksum(string $value): bool
    {
        return Util::postnet($value);
    }

    public function getLength(): array
    {
        return self::LENGTH;
    }
}
