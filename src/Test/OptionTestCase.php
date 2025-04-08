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

namespace Mezcalito\ImgproxyBundle\Test;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

abstract class OptionTestCase extends TestCase
{
    abstract public static function getOptionClass(): string;

    abstract public static function getOptionTests(): iterable;

    #[DataProvider('getOptionTests')]
    public function testResolve(array $params, string $result): void
    {
        $option = (new (static::getOptionClass())($params));
        $this->assertEquals($result, $option->resolve());
    }
}
