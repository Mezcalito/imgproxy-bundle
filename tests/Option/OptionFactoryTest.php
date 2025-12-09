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

use Mezcalito\ImgproxyBundle\Option\OptionFactory;
use Mezcalito\ImgproxyBundle\Option\Resize;
use PHPUnit\Framework\TestCase;

class OptionFactoryTest extends TestCase
{
    public function testGenerateOptionFromValidName(): void
    {
        $result = OptionFactory::fromName('resize', []);

        $this->assertInstanceOf(Resize::class, $result);
    }

    public function testGenerateOptionFromInvalidName(): void
    {
        $this->expectException(\Throwable::class);

        OptionFactory::fromName('invalid', []);
    }
}
