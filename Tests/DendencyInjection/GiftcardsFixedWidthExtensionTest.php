<?php
/**
 * Created by PhpStorm.
 * User: jderay
 * Date: 5/21/14
 * Time: 8:23 PM
 */

namespace Giftcards\FixedWidthBundle\Tests\DependencyInjection;


use Giftcards\FixedWidth\Tests\TestCase;
use Giftcards\FixedWidthBundle\DependencyInjection\GiftcardsFixedWidthExtension;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class GiftcardsFixedWidthExtensionTest extends TestCase
{
    /** @var  GiftcardsFixedWidthExtension */
    protected $extension;

    public function setUp()
    {
        $this->extension = new GiftcardsFixedWidthExtension();
    }

    public function testLoad()
    {
        $container = new ContainerBuilder();
        $container->setParameter('kernel.bundles', array());
        $container->setParameter('kernel.root_dir', __DIR__);
        $this->extension->load(array(), $container);
        $this->assertContains(
            new FileResource(__DIR__.'/../../Resources/config/services.yml'),
            $container->getResources(),
            '',
            false,
            false
        );
    }
}
 