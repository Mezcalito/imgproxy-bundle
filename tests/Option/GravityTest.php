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
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class GravityTest extends TestCase
{
    public function testGetName(): void
    {
        $this->assertEquals('gravity', (new Gravity(['type' => 'ce', 'x_offset' => 0, 'y_offset' => 0]))->getName());
    }

    #[DataProvider('options')]
    public function testResolve(array $params, string $result): void
    {
        $this->assertEquals($result, (new Gravity($params))->resolve());
    }

    public static function options(): iterable
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
