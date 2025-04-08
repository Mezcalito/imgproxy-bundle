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

use Mezcalito\ImgproxyBundle\Option\Resize;
use Mezcalito\ImgproxyBundle\Test\OptionTestCase;

class ResizeTest extends OptionTestCase
{
    public static function getOptionClass(): string
    {
        return Resize::class;
    }

    public static function getOptionTests(): iterable
    {
        yield [
            'params' => [
                'resizing_type' => 'fit',
                'width' => 150,
                'height' => 75,
            ],
            'result' => 'resize:fit:150:75',
        ];
        yield [
            'params' => [
                'resizing_type' => 'fit',
                'width' => 0,
                'height' => 75,
            ],
            'result' => 'resize:fit:0:75',
        ];
        yield [
            'params' => [
                'resizing_type' => 'fit',
                'width' => 150,
                'height' => 0,
            ],
            'result' => 'resize:fit:150:0',
        ];
        yield [
            'params' => [
                'resizing_type' => 'fit',
                'width' => 150,
                'height' => 75,
                'enlarge' => true,
                'extend' => [
                    'extend' => false,
                ],
            ],
            'result' => 'resize:fit:150:75:true:false',
        ];
        yield [
            'params' => [
                'resizing_type' => 'fit',
                'width' => 150,
                'height' => 75,
                'enlarge' => true,
                'extend' => [
                    'extend' => false,
                    'gravity' => [
                        'type' => 'ce',
                        'x_offset' => 0,
                        'y_offset' => 0,
                    ],
                ],
            ],
            'result' => 'resize:fit:150:75:true:false:ce:0:0',
        ];
    }
}
