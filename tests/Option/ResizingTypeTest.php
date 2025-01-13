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

use Mezcalito\ImgproxyBundle\Option\ResizingType;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ResizingTypeTest extends TestCase
{
    public function testGetName(): void
    {
        $this->assertEquals('resizing_type', (new ResizingType([]))->getName());
    }

    #[DataProvider('options')]
    public function testResolve(array $params, string $result): void
    {
        $this->assertEquals($result, (new ResizingType($params))->resolve());
    }

    public static function options(): iterable
    {
        yield [
            'params' => ['resizing_type' => 'fit'],
            'result' => 'resizing_type:fit',
        ];
    }
}
