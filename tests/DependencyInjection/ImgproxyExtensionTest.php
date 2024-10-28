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

namespace Mezcalito\ImgproxyBundle\Tests\DependencyInjection;

use Mezcalito\ImgproxyBundle\DependencyInjection\ImgproxyExtension;
use Mezcalito\ImgproxyBundle\ImgproxyBundle;
use Mezcalito\ImgproxyBundle\Resolver;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\RequestStack;

class ImgproxyExtensionTest extends TestCase
{
    public function testDefaultPresetSettings(): void
    {
        $container = $this->getContainer([
            'presets' => [
                'thumbnail' => [
                    'format' => 'webp',
                    'options' => [
                        'resize' => ['width' => 150, 'height' => 75],
                    ],
                ],
            ],
        ]);
        $container->compile();

        /** @var ?Resolver $resolver */
        $resolver = $container->get('imgproxy.resolver');
        $this->assertNotNull($resolver);

        $presets = $container->getParameter('imgproxy.presets');
        $this->assertCount(1, $presets);
        $this->assertArrayHasKey('thumbnail', $presets);

        $preset = \array_shift($presets);
        $this->assertEquals('webp', $preset['format']);
        $this->assertTrue($preset['encode']);
        $this->assertArrayHasKey('options', $preset);
        $options = $preset['options'];
        $this->assertArrayHasKey('resize', $options);
    }

    private function getContainer(array $data = []): ContainerBuilder
    {
        $container = new ContainerBuilder();
        $container->set('request_stack', $this->createMock(RequestStack::class));

        $bundle = new ImgproxyBundle();
        $bundle->build($container);

        $extension = new ImgproxyExtension();
        $extension->load(['imgproxy' => \array_merge([
            'host' => 'http://localhost:8080',
            'signature' => ['key' => 'c27f2c1d', 'salt' => 'fa242e79'],
        ], $data)], $container);

        $container->getDefinition('imgproxy.resolver')->setPublic(true);

        return $container;
    }
}
