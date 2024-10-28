<?php

declare(strict_types=1);

/*
 * This file is part of the Mezcalito ImgproxyBundle.
 *
 * (c) Mezcalito <dev@mezcalito.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mezcalito\ImgproxyBundle\Option;

use function Symfony\Component\String\u;

final class OptionFactory
{
    public static function fromName(string $optionName, array $optionParams): OptionInterface
    {
        $fqcn = '\\Mezcalito\\ImgproxyBundle\\Option\\' . u($optionName)->camel()->title()->toString();

        return new $fqcn($optionParams);
    }
}
