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

use Mezcalito\ImgproxyBundle\Option\Extend;
use Mezcalito\ImgproxyBundle\Test\OptionTestCase;

class ExtendTest extends OptionTestCase
{
    public static function getOptionClass(): string
    {
        return Extend::class;
    }

    public static function getOptionTests(): iterable
    {
        yield [
            'params' => ['extend' => false, 'gravity' => ['type' => 'ce', 'x_offset' => 0, 'y_offset' => 0]],
            'result' => 'extend:false:ce:0:0',
        ];
        yield [
            'params' => ['extend' => false],
            'result' => 'extend:false',
        ];
    }
}
