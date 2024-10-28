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
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ResizeTest extends TestCase
{
    public function testGetName(): void
    {
        $this->assertEquals('resize', (new Resize(['resizing_type' => 'fit', 'width' => 150, 'height' => 75]))->getName());
    }

    #[DataProvider('options')]
    public function testResolve(array $params, string $result): void
    {
        $this->assertEquals($result, (new Resize($params))->resolve());
    }

    public static function options(): iterable
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
