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

namespace Mezcalito\ImgproxyBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class ImgproxyExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $presets = $this->createPresets($config['default_preset_settings'], $config['presets']);

        $container->setParameter('imgproxy.host', $config['host']);
        $container->setParameter('imgproxy.signature.key', $config['signature']['key']);
        $container->setParameter('imgproxy.signature.salt', $config['signature']['salt']);
        $container->setParameter('imgproxy.presets', $presets);
    }

    private function createPresets(array $defaultPreset, array $presets): array
    {
        return \array_map(function (array $presets) use ($defaultPreset) {
            return \array_replace_recursive($presets, $defaultPreset);
        }, $presets);
    }
}
