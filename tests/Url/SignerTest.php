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

use Mezcalito\ImgproxyBundle\Url\Signer;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SignerTest extends TestCase
{
    #[DataProvider('path')]
    public function testGenerateSignature(string $path, string $result): void
    {
        $signer = new Signer('c27f2c1d', 'fa242e79');

        $this->assertEquals($result, $signer->generateSignature($path));
    }

    public static function path(): iterable
    {
        yield [
            'path' => '/resize:fit:150:75:1/https://fakeimg.pl/350x200/?text=Mezcalito@webp',
            'result' => 'dFsNT9cy24vWWyIdVAqxRVVsGHDYGk-MdMmBSPzDK64',
        ];
        yield [
            'path' => '/resize:fit:150:75:1/https://fakeimg.pl/350x200/?text=Mezc%40lito@webp',
            'result' => '3hikkYgQ2knT9lRlilkHMevcYF4drvWmoFSBYpGtDVU',
        ];
        yield [
            'path' => '/resize:fit:150:75:1/aHR0cHM6Ly9mYWtl/aW1nLnBsLzM1MHgy/MDAvP3RleHQ9TWV6/Y2FsaXRv.webp',
            'result' => 'nXZqRoPwmxLFO8YcKth6EbDDnWDYPLGKFN07m2JtOcg',
        ];
        yield [
            'path' => '/resize:fit:150:75:1/aHR0cHM6Ly9mYWtl/aW1nLnBsLzM1MHgy/MDAvP3RleHQ9TWV6/Y0BsaXRv.webp',
            'result' => 'r_AQMj4BBLZATF4kZipFK9UDMfXe-CZCYl7pIpHlLHA',
        ];
    }
}
