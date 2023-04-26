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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class ResolverTest extends TestCase
{
    private Resolver $resolver;

    #[DataProvider('plainUrl')]
    public function testCreatePlainUrl(string $src, string $filter, string $result): void
    {
        $this->addingContainer();

        $this->assertEquals($result, $this->resolver->getBrowserPath($src, $filter));
    }

    #[DataProvider('encodedUrl')]
    public function testCreateEncodedUrl(string $src, string $filter, string $result): void
    {
        $this->addingContainer();

        $this->assertEquals($result, $this->resolver->getBrowserPath($src, $filter));
    }

    #[DataProvider('localUrlWithoutMediaUrl')]
    public function testCreateLocalUrlWithoutMediaUrl(string $src, string $filter, string $result): void
    {
        $this->addingContainer();

        $this->assertEquals($result, $this->resolver->getBrowserPath($src, $filter));
    }

    #[DataProvider('localUrlWithoutMediaUrl')]
    public function testCreateLocalUrlWithoutMediaUrlAndRequest(string $src, string $filter, string $result): void
    {
        $this->addingContainer(false, false);

        $this->expectException(\LogicException::class);
        $this->resolver->getBrowserPath($src, $filter);
    }

    #[DataProvider('localUrlWithMediaUrl')]
    public function testCreateLocalUrlWithMediaUrl(string $src, string $filter, string $result): void
    {
        $this->addingContainer(true);

        $this->assertEquals($result, $this->resolver->getBrowserPath($src, $filter));
    }

    public function testWrongPresetName(): void
    {
        $this->addingContainer();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unknown preset "test"');

        $this->resolver->getBrowserPath('https://fakeimg.pl/350x200/?text=Mezcalito', 'test');
    }

    public static function plainUrl(): iterable
    {
        yield [
            'src' => 'https://fakeimg.pl/350x200/?text=Mezcalito',
            'filter' => 'plain_thumbnail',
            'result' => 'http://localhost:8080/MB8RT35YK91aiLS1hNXW3QpNCMS4ukBJyz0gIOsZAYI/resize:fit:150:75:true/plain/https://fakeimg.pl/350x200/?text=Mezcalito@webp',
        ];
        yield [
            'src' => 'https://fakeimg.pl/350x200/?text=Mezc@lito',
            'filter' => 'plain_thumbnail',
            'result' => 'http://localhost:8080/mBT7dYek5ZP36f0FAuJB4P1hvqBFed_FC2dUngL-fO4/resize:fit:150:75:true/plain/https://fakeimg.pl/350x200/?text=Mezc%40lito@webp',
        ];
    }

    public static function encodedUrl(): iterable
    {
        yield [
            'src' => 'https://fakeimg.pl/350x200/?text=Mezcalito',
            'filter' => 'encoded_thumbnail',
            'result' => 'http://localhost:8080/4fX6MWmCU4MyKScMDtlnUWWoPyfOgWHQ2qCybEyGfPw/resize:fit:150:75:true/aHR0cHM6Ly9mYWtl/aW1nLnBsLzM1MHgy/MDAvP3RleHQ9TWV6/Y2FsaXRv.webp',
        ];
        yield [
            'src' => 'https://fakeimg.pl/350x200/?text=Mezc@lito',
            'filter' => 'encoded_thumbnail',
            'result' => 'http://localhost:8080/KX0fg5LdXQZXlycY6gXWiJ1hKOdoXYr53LkuRJswDAQ/resize:fit:150:75:true/aHR0cHM6Ly9mYWtl/aW1nLnBsLzM1MHgy/MDAvP3RleHQ9TWV6/Y0BsaXRv.webp',
        ];
    }

    public static function localUrlWithoutMediaUrl(): iterable
    {
        yield [
            'src' => 'image.png',
            'filter' => 'encoded_thumbnail',
            'result' => 'http://localhost:8080/efA8fwEDYoRdy5YUDLDuht7TRiaVVLxW8CMWzvTd2uo/resize:fit:150:75:true/bG9jYWxob3N0aW1h/Z2UucG5n.webp',
        ];
    }

    public static function localUrlWithMediaUrl(): iterable
    {
        yield [
            'src' => 'image.png',
            'filter' => 'encoded_thumbnail',
            'result' => 'http://localhost:8080/r22LpKz7LG_mplSJZApPsoOyH1OO_xFEVobHcfV3tDY/resize:fit:150:75:true/aHR0cDovL2V4YW1w/bGUubG9jYWwvaW1h/Z2UucG5n.webp',
        ];
    }

    private function addingContainer(bool $withMediaUrl = false, bool $withRequest = true): void
    {
        $container = $this->createContainer($withMediaUrl);
        $requestStack = $this->createMock(RequestStack::class);
        $requestStack->expects($this->atMost(1))
            ->method('getCurrentRequest')->willReturn($withRequest ? Request::create('http//localhost') : null);
        $container->set('request_stack', $requestStack);
        $this->resolver = $container->get(Resolver::class);
    }

    private function createContainer(bool $withMediaUrl = false): ContainerBuilder
    {
        $container = new ContainerBuilder();

        $extension = new ImgproxyExtension();

        $options = [
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
        ];

        if ($withMediaUrl) {
            $options['media_url'] = 'http://example.local';
        }

        $extension->load([$options], $container);

        return $container;
    }
}
