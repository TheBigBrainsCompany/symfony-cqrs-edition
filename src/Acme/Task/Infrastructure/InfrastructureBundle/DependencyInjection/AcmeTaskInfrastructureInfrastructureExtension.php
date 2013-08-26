<?php

namespace Acme\Task\Infrastructure\InfrastructureBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 */
class AcmeTaskInfrastructureInfrastructureExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        // Domain
        $loader->load('domain/command_handlers.xml');
        $loader->load('domain/repositories.xml');

        // Data
        $loader->load('query/repositories.xml');
        $loader->load('query/event_handlers.xml');
    }
}
