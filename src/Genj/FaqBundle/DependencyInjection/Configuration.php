<?php

namespace Genj\FaqBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 *
 * @package Genj\FaqBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('genj_faq');

        $rootNode
            ->children()
                ->arrayNode('persistence')
                    ->children()
                        ->arrayNode('admin')
                            ->children()
                                ->scalarNode('dashboard_group')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->booleanNode('select_first_category_by_default')->defaultFalse()->end()
                ->booleanNode('select_first_question_by_default')->defaultFalse()->end()
            ->end();

        return $treeBuilder;
    }
}
