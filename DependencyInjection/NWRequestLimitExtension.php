<?php

namespace NW\RequestLimitBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use \Exception;

/**
 * Class NWRequestLimitExtension
 * @package NW\RequestLimitBundle\DependencyInjection
 * @author Novikov Viktor
 */
class NWRequestLimitExtension extends Extension
{
    /**
     * Loads a specific configuration.
     *
     * @param array $configs
     * @param ContainerBuilder $container
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $providerType = $config['provider_type'];
        $providerConfiguration = $config['provider_configuration'];
        $restrictionTime = $config['restriction_time'];

        $container->setParameter('nw_request_limit.provider_type', $providerType);
        $container->setParameter('nw_request_limit.provider_configuration', $providerConfiguration);
        $container->setParameter('nw_request_limit.restriction_time', $restrictionTime);
    }
}
