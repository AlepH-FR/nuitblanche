<?php

namespace IHQS\NuitBlancheBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;

abstract class BaseFixturesData extends AbstractFixture
{
	protected $manager;
	
	public function load($manager)
	{
		$this->manager = $manager;
		$this->doLoad();
	}

	abstract function doLoad();

	public function hasReference($name)
	{
		try
		{
			$this->getReference($name);
		} 
		catch(\ErrorException $e) {
			return false;
		}

		return true;
	}

	public function getReference($name)
	{
		try {
                return $this->manager->merge(parent::getReference($name));
		} 
		catch(\Doctrine\ORM\EntityNotFoundException $e) {
			var_dump($name);
			die;
		}
	}
	
    public function registerObjects($namespace, array $objects)
    {
		foreach($objects as $key => $object)
		{
			$this->registerObject($namespace.':'.$key, $object);
		}
	}

    public function registerObject($name, $object)
	{
		$this->manager->persist($object);
		$this->manager->flush();

		$this->addReference($name, $object);
    }
}