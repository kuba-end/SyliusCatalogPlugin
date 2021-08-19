<?php

/*
 * This file was created by developers working at BitBag
 * Do you need more information about us and what we do? Visit our https://bitbag.io website!
 * We are hiring developers from all over the world. Join us and start your new, exciting adventure and become part of us: https://bitbag.io/career
*/

declare(strict_types=1);

namespace BitBag\SyliusCatalogPlugin;

use BitBag\SyliusCatalogPlugin\DependencyInjection\Compiler\CatalogRuleCheckersPass;
use BitBag\SyliusCatalogPlugin\DependencyInjection\Compiler\CatalogSortChecker;
use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class BitBagSyliusCatalogPlugin extends Bundle
{
    use SyliusPluginTrait;

    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new CatalogRuleCheckersPass());
        $container->addCompilerPass(new CatalogSortChecker());
    }
}
