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

class Watermark extends Option
{
    public function getParts(): array
    {
        $parts = [];

        // opacity is required
        if (\array_key_exists('opacity', $this->params)) {
            $parts[] = $this->params['opacity'];
        }

        // position is optional
        if (\array_key_exists('position', $this->params)) {
            $parts[] = $this->params['position'];
        }

        // x_offset is optional
        if (\array_key_exists('x_offset', $this->params)) {
            $parts[] = $this->params['x_offset'];
        }

        // y_offset is optional
        if (\array_key_exists('y_offset', $this->params)) {
            $parts[] = $this->params['y_offset'];
        }

        // scale is optional
        if (\array_key_exists('scale', $this->params)) {
            $parts[] = $this->params['scale'];
        }

        return $parts;
    }
}
