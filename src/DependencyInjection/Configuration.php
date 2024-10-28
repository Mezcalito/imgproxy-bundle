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
                ->scalarNode('media_url')->end()
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
                            ->scalarNode('format')->defaultNull()->end()
                            ->booleanNode('encode')->defaultNull()->end()
                            ->arrayNode('options')
                                ->children()
                                    ->arrayNode('resize')
                                        ->children()
                                            ->enumNode('resizing_type')
                                                ->values(['fit', 'fill', 'fill-down', 'force', 'auto'])
                                                ->defaultValue('fit')
                                            ->end()
                                            ->integerNode('width')->defaultValue(0)->min(0)->end()
                                            ->integerNode('height')->defaultValue(0)->min(0)->end()
                                            ->booleanNode('enlarge')->end()
                                            ->arrayNode('extend')
                                                ->children()
                                                    ->booleanNode('extend')->defaultFalse()->end()
                                                    ->arrayNode('gravity')
                                                        ->children()
                                                            ->enumNode('type')
                                                                ->values(['no', 'so', 'ea', 'we', 'noea', 'nowe', 'soea', 'sowe', 'ce'])
                                                                ->defaultValue('ce')
                                                            ->end()
                                                            ->integerNode('x_offset')->defaultValue(0)->end()
                                                            ->integerNode('y_offset')->defaultValue(0)->end()
                                                        ->end()
                                                    ->end()
                                                ->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                    ->arrayNode('rotate')
                                        ->children()
                                            ->enumNode('angle')
                                                ->values([0, 90, 180, 270])
                                            ->end()
                                        ->end()
                                    ->end()
                                    ->arrayNode('height')
                                        ->children()
                                            ->integerNode('height')->min(0)->end()
                                        ->end()
                                    ->end()
                                    ->arrayNode('width')
                                        ->children()
                                            ->integerNode('width')->min(0)->end()
                                        ->end()
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
