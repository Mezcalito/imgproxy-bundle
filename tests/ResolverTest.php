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

namespace Mezcalito\ImgproxyBundle\Tests;

use Mezcalito\ImgproxyBundle\DependencyInjection\ImgproxyExtension;
use Mezcalito\ImgproxyBundle\Resolver;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ResolverTest extends TestCase
{
    private Resolver $resolver;

    protected function setUp(): void
    {
        $this->resolver = $this->createContainer()->get(Resolver::class);
    }

    #[DataProvider('plainUrl')]
    public function testCreatePlainUrl(string $src, string $filter, string $result): void
    {
        $this->assertEquals($result, $this->resolver->getBrowserPath($src, $filter));
    }

    #[DataProvider('encodedUrl')]
    public function testCreateEncodedUrl(string $src, string $filter, string $result): void
    {
        $this->assertEquals($result, $this->resolver->getBrowserPath($src, $filter));
    }

    public function testWrongPresetName(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unknown preset "test"');

        $this->resolver->getBrowserPath('https://fakeimg.pl/350x200/?text=Mezcalito', 'test');
    }

    public static function plainUrl(): iterable
    {
        yield [
            'src' => 'https://fakeimg.pl/350x200/?text=Mezcalito',
            'filter' => 'plain_thumbnail',
            'result' => 'http://localhost:8080/Qt1H_pr0HR3o4rxVH-JSVd9bGvXo54Z_9uTKadWYetI/resize:fit:150:75:1/plain/https://fakeimg.pl/350x200/?text=Mezcalito@webp',
        ];
        yield [
            'src' => 'https://fakeimg.pl/350x200/?text=Mezc@lito',
            'filter' => 'plain_thumbnail',
            'result' => 'http://localhost:8080/YkPvhnTrixp_UA5eczNCY9NvZIUVUsN1YtdyYHhNKcA/resize:fit:150:75:1/plain/https://fakeimg.pl/350x200/?text=Mezc%40lito@webp',
        ];
    }

    public static function encodedUrl(): iterable
    {
        yield [
            'src' => 'https://fakeimg.pl/350x200/?text=Mezcalito',
            'filter' => 'encoded_thumbnail',
            'result' => 'http://localhost:8080/wEM6jtZJLUR0kU_p0V8stthB-YkoaL0jm7fyhUlbyqo/resize:fit:150:75:1/aHR0cHM6Ly9mYWtl/aW1nLnBsLzM1MHgy/MDAvP3RleHQ9TWV6/Y2FsaXRv.webp',
        ];
        yield [
            'src' => 'https://fakeimg.pl/350x200/?text=Mezc@lito',
            'filter' => 'encoded_thumbnail',
            'result' => 'http://localhost:8080/qDoj1F--3M3fei_tgu62mWzJbGDJhYUor3-CJ1YKiJk/resize:fit:150:75:1/aHR0cHM6Ly9mYWtl/aW1nLnBsLzM1MHgy/MDAvP3RleHQ9TWV6/Y0BsaXRv.webp',
        ];
    }

    private function createContainer(): ContainerBuilder
    {
        $container = new ContainerBuilder();

        $extension = new ImgproxyExtension();
        $extension->load([[
            'host' => 'http://localhost:8080',
            'signature' => ['key' => 'c27f2c1d', 'salt' => 'fa242e79'],
            'default_preset_settings' => [
                'format' => 'png',
                'encode' => false,
            ],
            'presets' => [
                'plain_thumbnail' => [
                    'format' => 'webp',
                    'resize' => ['width' => 150, 'height' => 75, 'enlarge' => true],
                ],
                'encoded_thumbnail' => [
                    'format' => 'webp',
                    'encode' => true,
                    'resize' => ['width' => 150, 'height' => 75, 'enlarge' => true],
                ],
            ],
        ]], $container);

        return $container;
    }
}
