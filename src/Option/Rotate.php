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

use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;

class Rotate extends Option
{
    public function getParts(): array
    {
        return [
            $this->params['rotate'],
        ];
    }

    public static function getConfig(): NodeDefinition
    {
        $root = new NodeBuilder();

        return $root
            ->enumNode('rotate')->values([0, 90, 180, 270]);
    }
}
