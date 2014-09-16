<?php

namespace Giftcards\FixedWidthBundle;

use
    Giftcards\FixedWidthBundle\DependencyInjection\Compiler\AddRecordSpecRecognizers;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class GiftcardsFixedWidthBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new AddRecordSpecRecognizers());
    }
}
