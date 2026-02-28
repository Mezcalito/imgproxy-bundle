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

use Mezcalito\ImgproxyBundle\Option\Watermark;
use Mezcalito\ImgproxyBundle\Test\OptionTestCase;

class WatermarkTest extends OptionTestCase
{
    public static function getOptionClass(): string
    {
        return Watermark::class;
    }

    public static function getOptionTests(): iterable
    {
        yield 'opacity only' => [
            'params' => ['opacity' => 0.5],
            'result' => 'watermark:0.5',
        ];

        yield 'opacity and position' => [
            'params' => [
                'opacity' => 0.8,
                'position' => 'noea',
            ],
            'result' => 'watermark:0.8:noea',
        ];

        yield 'opacity, position and offsets' => [
            'params' => [
                'opacity' => 1,
                'position' => 'so',
                'x_offset' => 10,
                'y_offset' => 20,
            ],
            'result' => 'watermark:1:so:10:20',
        ];

        yield 'all parameters' => [
            'params' => [
                'opacity' => 0.7,
                'position' => 're',
                'x_offset' => 15,
                'y_offset' => 25,
                'scale' => 0.5,
            ],
            'result' => 'watermark:0.7:re:15:25:0.5',
        ];

        yield 'opacity, position and scale' => [
            'params' => [
                'opacity' => 0.9,
                'position' => 'ce',
                'x_offset' => 0,
                'y_offset' => 0,
                'scale' => 0.3,
            ],
            'result' => 'watermark:0.9:ce:0:0:0.3',
        ];
    }
}
