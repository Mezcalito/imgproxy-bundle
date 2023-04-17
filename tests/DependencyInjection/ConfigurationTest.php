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

use Mezcalito\ImgproxyBundle\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Processor;

class ConfigurationTest extends TestCase
{
    public function testDefaultConfig()
    {
        $processor = new Processor();
        $config = $processor->processConfiguration(new Configuration(), [[
            'host' => 'http://localhost:8080',
            'signature' => ['key' => 'c27f2c1d', 'salt' => 'fa242e79'],
        ]]);

        $this->assertEquals(self::getBundleDefaultConfig(), $config);
    }

    private static function getBundleDefaultConfig(): array
    {
        return [
            'host' => 'http://localhost:8080',
            'signature' => [
                'key' => 'c27f2c1d',
                'salt' => 'fa242e79',
            ],
            'default_preset_settings' => [
                'format' => 'webp',
                'encode' => true,
            ],
            'presets' => [],
        ];
    }
}
