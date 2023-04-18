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

namespace Mezcalito\ImgproxyBundle\Tests\Url;

use Mezcalito\ImgproxyBundle\Url\Encoder;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class EncoderTest extends TestCase
{
    #[DataProvider('url')]
    public function testEncodeAndSplit(string $path, bool $split, string $result): void
    {
        $encoder = new Encoder();

        $this->assertEquals($result, $encoder->encode($path, $split));
    }

    public static function url(): iterable
    {
        yield [
            'path' => 'https://fakeimg.pl/350x200/?text=Mezcalito',
            'split' => false,
            'result' => 'aHR0cHM6Ly9mYWtlaW1nLnBsLzM1MHgyMDAvP3RleHQ9TWV6Y2FsaXRv',
        ];
        yield [
            'path' => 'https://fakeimg.pl/350x200/?text=Mezc@lito',
            'split' => false,
            'result' => 'aHR0cHM6Ly9mYWtlaW1nLnBsLzM1MHgyMDAvP3RleHQ9TWV6Y0BsaXRv',
        ];
        yield [
            'path' => 'https://fakeimg.pl/350x200/?text=Mezcalito',
            'split' => true,
            'result' => 'aHR0cHM6Ly9mYWtl/aW1nLnBsLzM1MHgy/MDAvP3RleHQ9TWV6/Y2FsaXRv',
        ];
        yield [
            'path' => 'https://fakeimg.pl/350x200/?text=Mezc@lito',
            'split' => true,
            'result' => 'aHR0cHM6Ly9mYWtl/aW1nLnBsLzM1MHgy/MDAvP3RleHQ9TWV6/Y0BsaXRv',
        ];
    }
}
