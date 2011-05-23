<?php

namespace IHQS\NuitBlancheBundle\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;
use IHQS\NuitBlancheBundle\Entity\GamePlayer;
use IHQS\NuitBlancheBundle\Entity\Player;

class GamePlayerEventSubscriber implements EventSubscriber
{
	private $em;
	private $uow;
	
	public function onFlush(OnFlushEventArgs $eventArgs)
	{
		$this->em	= $eventArgs->getEntityManager();
        $this->uow	= $this->em->getUnitOfWork();

        foreach ($this->uow->getScheduledEntityInsertions() AS $entity)
		{
			$this->updateEntity($entity);
        }

        foreach ($this->uow->getScheduledEntityUpdates() AS $entity)
		{
			$this->updateEntity($entity);
        }
    }

	public function updateEntity($entity)
	{
		if($entity instanceof GamePlayer)
		{
			$player = $this->em->getRepository('IHQS\NuitBlancheBundle\Entity\Player')->findOneBySc2Account($entity->getName());
			if($player)
			{
				$entity->setName($name);
				$entity->setPlayer($player);
				$this->em->persist($entity);
				$this->uow->computeChangeSet($this->em->getClassMetadata('IHQS\NuitBlancheBundle\Entity\GamePlayer'), $entity);
			}
		}
	}

    public function getSubscribedEvents()
    {
        return array(
			Events::onFlush
		);
    }
}