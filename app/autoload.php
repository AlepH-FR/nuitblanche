<?php

use Symfony\Component\ClassLoader\UniversalClassLoader;
use Doctrine\Common\Annotations\AnnotationRegistry;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony'          => array(__DIR__.'/../vendor/symfony/src', __DIR__.'/../vendor/bundles'),
    'Sensio'           => __DIR__.'/../vendor/bundles',
    'JMS'              => __DIR__.'/../vendor/bundles',
	'Bundle\\ForumBundle' => __DIR__.'/../vendor/bundles',
	'Doctrine\\Common\\DataFixtures' => __DIR__.'/../vendor/doctrine-fixtures/lib',
    'Doctrine\\Common' => __DIR__.'/../vendor/doctrine-common/lib',
    'Doctrine\\DBAL'   => __DIR__.'/../vendor/doctrine-dbal/lib',
    'Doctrine'         => __DIR__.'/../vendor/doctrine/lib',
    'Zend'			   => __DIR__.'/../vendor/zend/library',
    'ZendPaginatorAdapter' => __DIR__.'/../vendor/zend-paginator-adapter/src',
    'Monolog'          => __DIR__.'/../vendor/monolog/src',
    'Assetic'          => __DIR__.'/../vendor/assetic/src',
    'DoctrineExtensions' => __DIR__.'/../vendor/doctrine-extensions/lib',
    'DoctrineExtensions\\Sluggable' => __DIR__.'/../vendor/doctrine-extensions-sluggable/lib',
    'SC2Chart'         => __DIR__.'/../vendor/sc2chart/src',
    'SC2Ranks'         => __DIR__.'/../vendor/sc2ranks/src',
    'Metadata'         => __DIR__.'/../vendor/metadata/src',
    'IHQS'             => __DIR__.'/../src',
	'WhiteOctober'		=> __DIR__.'/../vendor/bundles',
    'Pagerfanta'		=> __DIR__.'/../vendor/pagerfanta/src',
));
$loader->registerPrefixes(array(
    'Twig_Extensions_' => __DIR__.'/../vendor/twig-extensions/lib',
    'Twig_'            => __DIR__.'/../vendor/twig/lib',
    'Swift_'           => __DIR__.'/../vendor/swiftmailer/lib/classes',
    'TeamSpeak3_'      => __DIR__.'/../vendor/ts3/libraries',
));
$loader->register();
$loader->registerPrefixFallbacks(array(
    __DIR__.'/../vendor/symfony/src/Symfony/Component/Locale/Resources/stubs',
));


AnnotationRegistry::registerLoader(function($class) use ($loader) {
    $loader->loadClass($class);
    return class_exists($class, false);
});
AnnotationRegistry::registerFile(__DIR__.'/../vendor/doctrine/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php');
