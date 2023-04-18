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

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class ImgproxyExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.php');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $container->getDefinition('imgproxy.resolver')->replaceArgument(0, rtrim($config['host'], '/'));
        $container->getDefinition('imgproxy.url.signer')
            ->replaceArgument(0, $config['signature']['key'])
            ->replaceArgument(1, $config['signature']['salt']);

        $presets = $this->createPresets($config['default_preset_settings'], $config['presets']);
        $container->setParameter('imgproxy.presets', $presets);
    }

    private function createPresets(array $defaultPreset, array $presets): array
    {
        return \array_map(function (array $presets) use ($defaultPreset) {
            return \array_replace_recursive($presets, $defaultPreset);
        }, $presets);
    }
}
