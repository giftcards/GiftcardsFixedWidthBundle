<?php
/**
 * Created by PhpStorm.
 * User: jderay
 * Date: 9/15/14
 * Time: 9:46 PM
 */

namespace Giftcards\FixedWidthBundle\Tests;


use Giftcards\FixedWidth\Tests\TestCase;
use Giftcards\FixedWidthBundle\GiftcardsFixedWidthBundle;
use Mockery;

class GiftcardsFixedWidthBundleTest extends TestCase
{
    /** @var GiftcardsFixedWidthBundle */
    protected $bundle;

    public function setUp() : void
    {
        $this->bundle = new GiftcardsFixedWidthBundle();
    }

    public function tearDown() : void
    {
        Mockery::close();
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testBuild()
    {
        $this->bundle->build(
            Mockery::mock('Symfony\Component\DependencyInjection\ContainerBuilder')
                ->shouldReceive('addCompilerPass')
                ->once()
                ->with('Giftcards\FixedWidthBundle\DependencyInjection\Compiler\AddRecordSpecRecognizers')
                ->getMock()
        );
    }
}
