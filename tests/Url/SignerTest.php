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
            'path' => 'resize:fit:848:565:1/https://fakeimg.pl/350x200/?text=Mezcalito@webp',
            'result' => \pack('H*', '554526608022262df50d9913d3d4c4e590b2ade8fba09de4ff89c5067129c057'),
        ];
        yield [
            'path' => 'resize:fit:848:565:1/https://fakeimg.pl/350x200/?text=Mezc%40lito@webp',
            'result' => \pack('H*', 'c18193198acbc9d467056514f2ba05ef59caffd42927d79ae6a9a80f1d8d88e7'),
        ];
        yield [
            'path' => 'resize:fit:848:565:1/aHR0cHM6Ly9mYWtl/aW1nLnBsLzM1MHgy/MDAvP3RleHQ9TWV6/Y2FsaXRv.webp',
            'result' => \pack('H*', '3a13480006206259e2b179c6edaa4497d2c5b07b4d08f1983ab0028ed25a7646'),
        ];
        yield [
            'path' => 'resize:fit:848:565:1/aHR0cHM6Ly9mYWtl/aW1nLnBsLzM1MHgy/MDAvP3RleHQ9TWV6/Y0BsaXRv.webp',
            'result' => \pack('H*', '20a892d8ee2c20782f3acddc129046162f1787d3d7d6daff532dd516c53ec081'),
        ];
    }
}
