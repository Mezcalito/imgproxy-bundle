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

class Resize extends Option
{
    public function getParts(): array
    {
        $parts = [];

        if (\array_key_exists('resizing_type', $this->params)) {
            $parts = \array_merge($parts, (new ResizingType(['resizing_type' => $this->params['resizing_type']]))->getParts());
        }

        if (\array_key_exists('width', $this->params)) {
            $parts = \array_merge($parts, (new Width(['width' => $this->params['width']]))->getParts());
        }

        if (\array_key_exists('height', $this->params)) {
            $parts = \array_merge($parts, (new Height(['height' => $this->params['height']]))->getParts());
        }

        if (\array_key_exists('enlarge', $this->params)) {
            $parts = \array_merge($parts, (new Enlarge(['enlarge' => $this->params['enlarge']]))->getParts());
        }

        if (\array_key_exists('extend', $this->params)) {
            $parts = \array_merge($parts, (new Extend($this->params['extend']))->getParts());
        }

        return $parts;
    }

    public static function getConfig(): NodeDefinition
    {
        $root = new NodeBuilder();

        // TODO: manage meta options
        return $root->end();
    }
}
