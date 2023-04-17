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
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ImgproxyExtensionTest extends TestCase
{
    public function testDefaultPresetSettings(): void
    {
        $container = $this->createContainer([
            'host' => 'http://localhost:8080',
            'signature' => ['key' => 'c27f2c1d', 'salt' => 'fa242e79'],
            'default_preset_settings' => [
                'format' => 'png',
                'encode' => false,
            ],
            'presets' => [
                'thumbnail' => [],
            ],
        ]);

        $presets = $container->getParameter('imgproxy.presets');
        $this->assertCount(1, $presets);
        $this->assertArrayHasKey('thumbnail', $presets);

        $preset = \array_shift($presets);
        $this->assertEquals('png', $preset['format']);
        $this->assertFalse($preset['encode']);
        $this->assertArrayHasKey('resize', $preset);
    }

    private function createContainer(array $data = []): ContainerBuilder
    {
        $container = new ContainerBuilder();

        $extension = new ImgproxyExtension();
        $extension->load([$data], $container);

        return $container;
    }
}
