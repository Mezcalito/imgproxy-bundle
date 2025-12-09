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

final class OptionFactory
{
    public static function fromName(string $optionName, array $optionParams): OptionInterface
    {
        $className = \ucfirst(\str_replace(' ', '', \ucwords(\str_replace('_', ' ', $optionName))));
        $fqcn = '\\Mezcalito\\ImgproxyBundle\\Option\\'.$className;

        return new $fqcn($optionParams);
    }
}
