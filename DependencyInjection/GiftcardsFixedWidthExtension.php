<?php

namespace Giftcards\FixedWidthBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class GiftcardsFixedWidthExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $dirs = array();

        foreach ($config['spec_loader']['paths'] as $path) {

            $dirs[] = $path;
        }

        // register bundles as Twig namespaces
        foreach ($container->getParameter('kernel.bundles') as $bundle => $class) {
            if (is_dir($dir = $container->getParameter('kernel.root_dir').'/Resources/'.$bundle.'/fixed_width')) {

                $dirs[] = $dir;
            }

            $reflection = new \ReflectionClass($class);
            if (is_dir($dir = dirname($reflection->getFilename()).'/Resources/fixed_width')) {

                $dirs[] = $dir;
            }
        }

        if (is_dir($dir = $container->getParameter('kernel.root_dir').'/Resources/fixed_width')) {

            $dirs[] = $dir;
        }

        $container->setParameter('giftcards.fixed_width.spec_file_dirs', $dirs);
        $container
            ->getDefinition('giftcards.fixed_width.file_factory')
            ->replaceArgument(0, new Reference($config['spec_loader']['id']))
            ->replaceArgument(1, new Reference($config['value_formatter_id']))
        ;
    }
}
