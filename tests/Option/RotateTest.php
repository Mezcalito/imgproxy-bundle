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

use Mezcalito\ImgproxyBundle\Option\Rotate;
use Mezcalito\ImgproxyBundle\Test\OptionTestCase;

class RotateTest extends OptionTestCase
{
    public static function getOptionClass(): string
    {
        return Rotate::class;
    }

    public static function getOptionTests(): iterable
    {
        yield [
            'params' => ['angle' => 90],
            'result' => 'rotate:90',
        ];
    }
}
