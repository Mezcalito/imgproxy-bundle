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

use Mezcalito\ImgproxyBundle\Option\Blur;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class BlurTest extends TestCase
{
    public function testGetName(): void
    {
        $this->assertEquals('blur', (new Blur(['sigma' => 2.5]))->getName());
    }

    #[DataProvider('options')]
    public function testResolve(array $params, string $result): void
    {
        $this->assertEquals($result, (new Blur($params))->resolve());
    }

    public static function options(): iterable
    {
        yield [
            'params' => [
                'sigma' => 2.5,
            ],
            'result' => 'blur:2.5',
        ];
    }
}
