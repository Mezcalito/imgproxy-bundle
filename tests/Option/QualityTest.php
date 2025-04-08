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

use Mezcalito\ImgproxyBundle\Option\Quality;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class QualityTest extends TestCase
{
    public function testGetName(): void
    {
        $this->assertEquals('quality', (new Quality(['quality' => 80]))->getName());
    }

    #[DataProvider('options')]
    public function testResolve(array $params, string $result): void
    {
        $this->assertEquals($result, (new Quality($params))->resolve());
    }

    public static function options(): iterable
    {
        yield [
            'params' => [
                'quality' => 80,
            ],
            'result' => 'quality:80',
        ];
    }
}
