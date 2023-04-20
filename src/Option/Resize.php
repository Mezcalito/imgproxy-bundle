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

class Resize extends Option
{
    public function getParts(): array
    {
        $parts = [];

        if (!empty($this->params['resizing_type'])) {
            $parts = \array_merge($parts, (new ResizingType(['resizing_type' => $this->params['resizing_type']]))->getParts());
        }

        if (!empty($this->params['width'])) {
            $parts = \array_merge($parts, (new Width(['width' => $this->params['width']]))->getParts());
        }

        if (!empty($this->params['height'])) {
            $parts = \array_merge($parts, (new Height(['height' => $this->params['height']]))->getParts());
        }

        if (!empty($this->params['enlarge'])) {
            $parts = \array_merge($parts, (new Enlarge(['enlarge' => $this->params['enlarge']]))->getParts());
        }

        if (!empty($this->params['extend'])) {
            $parts = \array_merge($parts, (new Extend($this->params['extend']))->getParts());
        }

        return $parts;
    }
}
