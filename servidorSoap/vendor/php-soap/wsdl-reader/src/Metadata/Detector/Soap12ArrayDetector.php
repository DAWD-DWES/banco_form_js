<?php
declare(strict_types=1);

namespace Soap\WsdlReader\Metadata\Detector;

use Soap\WsdlReader\Model\Definitions\EncodingStyle;

final class Soap12ArrayDetector
{
    public static function detect(string $namespace, string $localName): bool
    {
        return mb_strtolower($localName) === 'array' && EncodingStyle::isSoap12Encoding($namespace);
    }
}
