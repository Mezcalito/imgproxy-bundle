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
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RotateTest extends TestCase
{
    public function testGetName(): void
    {
        $this->assertEquals('rotate', (new Rotate(['angle' => 90]))->getName());
    }

    #[DataProvider('options')]
    public function testResolve(array $params, string $result): void
    {
        $this->assertEquals($result, (new Rotate($params))->resolve());
    }

    public static function options(): iterable
    {
        yield [
            'params' => [
                'angle' => 90,
            ],
            'result' => 'rotate:90',
        ];
    }
}
