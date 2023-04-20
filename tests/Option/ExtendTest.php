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
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ExtendTest extends TestCase
{
    public function testGetName(): void
    {
        $this->assertEquals('extend', (new Extend(['extend' => true]))->getName());
    }

    #[DataProvider('options')]
    public function testResolve(array $params, string $result): void
    {
        $this->assertEquals($result, (new Extend($params))->resolve());
    }

    public static function options(): iterable
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
