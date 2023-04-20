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

class Extend extends Option
{
    public function getParts(): array
    {
        $parts = [$this->params['extend'] ? 'true' : 'false'];

        if (!empty($this->params['gravity'])) {
            $gravity = new Gravity($this->params['gravity']);
            $parts = \array_merge($parts, $gravity->getParts());
        }

        return $parts;
    }
}
