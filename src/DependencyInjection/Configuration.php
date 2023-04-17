<?php

namespace Mezcalito\ImgproxyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('imgproxy');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->fixXmlConfig('preset', 'presets')
            ->children()
                ->scalarNode('host')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->arrayNode('signature')
                    ->children()
                        ->scalarNode('key')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('salt')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('default_preset_settings')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('format')->defaultValue('webp')->end()
                        ->booleanNode('encode')->defaultTrue()->end()
                    ->end()
                ->end()
                ->arrayNode('presets')
                    ->useAttributeAsKey('name')
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('format')->defaultValue('webp')->end()
                            ->booleanNode('encode')->defaultTrue()->end()
                            ->arrayNode('resize')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->integerNode('width')->min(0)->end()
                                    ->integerNode('height')->min(0)->end()
                                    ->enumNode('mode')
                                        ->values(['fit', 'fill', 'fill-down', 'force', 'auto'])
                                        ->defaultValue('fit')
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
