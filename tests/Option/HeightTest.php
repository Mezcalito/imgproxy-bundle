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

use Mezcalito\ImgproxyBundle\Option\Height;
use Mezcalito\ImgproxyBundle\Test\OptionTestCase;

class HeightTest extends OptionTestCase
{
    public static function getOptionClass(): string
    {
        return Height::class;
    }

    public static function getOptionTests(): iterable
    {
        yield [
            'params' => ['height' => '42'],
            'result' => 'height:42',
        ];
    }
}
