<?php
namespace GFB\RestClientBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('gfb_rest_client');

        $rootNode
            ->children()

            ->arrayNode('foo')->prototype('scalar')->end()->end()

            ->end();

        return $treeBuilder;
    }
}