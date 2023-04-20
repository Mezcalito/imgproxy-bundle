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

class Gravity extends Option
{
    public function getParts(): array
    {
        return [
            $this->params['type'],
            $this->params['x_offset'],
            $this->params['x_offset'],
        ];
    }
}
