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

use Mezcalito\ImgproxyBundle\Option\Enlarge;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class EnlargeTest extends TestCase
{
    public function testGetName(): void
    {
        $this->assertEquals('enlarge', (new Enlarge(['enlarge' => false]))->getName());
    }

    #[DataProvider('options')]
    public function testResolve(array $params, string $result): void
    {
        $this->assertEquals($result, (new Enlarge($params))->resolve());
    }

    public static function options(): iterable
    {
        yield [
            'params' => ['enlarge' => false],
            'result' => 'enlarge:false',
        ];
        yield [
            'params' => ['enlarge' => true],
            'result' => 'enlarge:true',
        ];
    }
}
