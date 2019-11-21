<?php
/**
 * Created by PhpStorm.
 * User: jderay
 * Date: 9/9/14
 * Time: 3:23 PM
 */

namespace Giftcards\FixedWidthBundle\DependencyInjection\Compiler;


use RuntimeException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class AddRecordSpecRecognizers implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('giftcards.fixed_width.file_factory')) {

            return;
        }

        $fileFactory = $container->getDefinition('giftcards.fixed_width.file_factory');

        foreach ($container->findTaggedServiceIds('giftcards.fixed_width.record_spec_recognizer') as $id => $tags) {

            foreach ($tags as $tag) {

                if (!isset($tag['spec_name'])) {

                    throw new RuntimeException('the tag giftcards.fixed_width.record_spec_recognizer must have a spec_name parameter.');
                }

                $fileFactory->addMethodCall(
                    'addRecordSpecRecognizer',
                    [$tag['spec_name'], new Reference($id)]
                );
            }
        }
    }
}