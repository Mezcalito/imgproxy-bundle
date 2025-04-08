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

namespace Mezcalito\ImgproxyBundle\Tests\Option;

use Mezcalito\ImgproxyBundle\Option\Gravity;
use Mezcalito\ImgproxyBundle\Test\OptionTestCase;

class GravityTest extends OptionTestCase
{
    public static function getOptionClass(): string
    {
        return Gravity::class;
    }

    public static function getOptionTests(): iterable
    {
        yield [
            'params' => ['type' => 'ce', 'x_offset' => 0, 'y_offset' => 0],
            'result' => 'gravity:ce:0:0',
        ];
        yield [
            'params' => ['type' => 'noea', 'x_offset' => 100, 'y_offset' => 100],
            'result' => 'gravity:noea:100:100',
        ];
    }
}
