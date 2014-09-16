<?php
/**
 * Created by PhpStorm.
 * User: jderay
 * Date: 5/21/14
 * Time: 8:23 PM
 */

namespace Giftcards\FixedWidthBundle\Tests\DependencyInjection;


use Giftcards\FixedWidthBundle\DependencyInjection\GiftcardsFixedWidthExtension;
use Omni\TestingBundle\TestCase\Extension\AbstractExtendableTestCase;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class GiftcardsFixedWidthExtensionTest extends AbstractExtendableTestCase
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
 