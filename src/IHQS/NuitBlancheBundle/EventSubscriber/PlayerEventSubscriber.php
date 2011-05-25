<?php

namespace IHQS\NuitBlancheBundle\EventSubscriber;

use IHQS\NuitBlancheBundle\Entity\GamePlayer;
use IHQS\NuitBlancheBundle\Entity\Player;

class PlayerEventSubscriber extends BaseEventSubscriber
{
	public function updateEntity($entity)
	{
		if(!$entity instanceof Player) { return; }

		$account = $entity->getSc2Account();
		if(!$account) { return ; }

		$games = $this->em->getRepository('IHQS\NuitBlancheBundle\Entity\GamePlayer')->findByName($account);
		if(count($games) > 0) { return ; }
			
		foreach($games as $game)
		{
			if(!is_null($game->getPlayer())) { continue; }

			$game->setPlayer($entity);
			$this->em->persist($game);
			$this->uow->computeChangeSet($this->em->getClassMetadata('IHQS\NuitBlancheBundle\Entity\GamePlayer'), $game);
		}
	}
}