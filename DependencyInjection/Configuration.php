<?php

namespace Giftcards\FixedWidthBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('giftcards_fixed_width')
            ->children()
                ->arrayNode('spec_loader')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('paths')
                            ->prototype('scalar')->end()
                        ->end()
                        ->scalarNode('id')
                            ->cannotBeEmpty()
                            ->defaultValue('giftcards.fixed_width.spec_loader')
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('value_formatter_id')
                    ->cannotBeEmpty()
                    ->defaultValue('giftcards.fixed_width.sprintf_value_formatter')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
