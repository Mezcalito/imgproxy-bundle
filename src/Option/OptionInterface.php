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

use Symfony\Component\Config\Definition\Builder\NodeDefinition;

interface OptionInterface
{
    public function getName(): string;

    public static function getConfig(): NodeDefinition;

    public function resolve(): string;
}
