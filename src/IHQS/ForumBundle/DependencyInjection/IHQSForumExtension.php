<?php

namespace IHQS\ForumBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

class IHQSForumExtension extends Extension
{

    public static function getRepository($em, $class)
    {
        return $em->getRepository($class);
    }
    
    public function load(array $configs, ContainerBuilder $container)
    {
    }

    public function getAlias()
    {
        return 'ihqs_forum';
    }
}
