<?php
/**
 * Created by PhpStorm.
 * User: jderay
 * Date: 9/15/14
 * Time: 9:26 PM
 */

namespace Giftcards\FixedWidthBundle\Tests\DependencyInjection\Compiler;


use Giftcards\FixedWidth\Tests\TestCase;
use
    Giftcards\FixedWidthBundle\DependencyInjection\Compiler\AddRecordSpecRecognizers;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class AddRecordSpecRecognizersTest extends TestCase
{
    /** @var AddRecordSpecRecognizers */
    protected $pass;

    public function setUp()
    {
        $this->pass = new AddRecordSpecRecognizers();
    }

    public function testProcessWhereFactoryNotThere()
    {
        $this->pass->process(new ContainerBuilder());
    }

    public function testProcessWhereFactoryThere()
    {
        $container = new ContainerBuilder();
        $recognizer1 = new Definition();
        $recognizer1->addTag('giftcards.fixed_width.record_spec_recognizer', array('spec_name' => 'spec1'));
        $recognizer2 = new Definition();
        $recognizer2->addTag('giftcards.fixed_width.record_spec_recognizer', array('spec_name' => 'spec2'));
        $service = new Definition();
        $container
            ->addDefinitions(array(
                'giftcards.fixed_width.file_factory' => new Definition(),
                'rec1' => $recognizer1,
                'rec2' => $recognizer2,
                'serv' => $service
            ))
        ;
        $this->pass->process($container);

        $this->assertContains(
            array('addRecordSpecRecognizer', array('spec1', new Reference('rec1'))),
            $container->getDefinition('giftcards.fixed_width.file_factory')->getMethodCalls()
        );
        $this->assertContains(
            array('addRecordSpecRecognizer', array('spec2', new Reference('rec2'))),
            $container->getDefinition('giftcards.fixed_width.file_factory')->getMethodCalls()
        );
        $this->assertNotContains(
            array('addRecordSpecRecognizer', array(null, new Reference('service'))),
            $container->getDefinition('giftcards.fixed_width.file_factory')->getMethodCalls()
        );
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testProcessWhereFactoryThereAndBadTag()
    {
        $container = new ContainerBuilder();
        $recognizer1 = new Definition();
        $recognizer1->addTag('giftcards.fixed_width.record_spec_recognizer', array('spec_name' => 'spec1'));
        $recognizer2 = new Definition();
        $recognizer2->addTag('giftcards.fixed_width.record_spec_recognizer');
        $service = new Definition();
        $container
            ->addDefinitions(array(
                'giftcards.fixed_width.file_factory' => new Definition(),
                'rec1' => $recognizer1,
                'rec2' => $recognizer2,
                'serv' => $service
            ))
        ;
        $this->pass->process($container);
    }
}
 