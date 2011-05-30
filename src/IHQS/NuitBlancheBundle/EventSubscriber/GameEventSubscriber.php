<?php

namespace IHQS\NuitBlancheBundle\EventSubscriber;

use IHQS\NuitBlancheBundle\Entity\Game;

class GameEventSubscriber extends BaseEventSubscriber
{
    public function updateEntity($entity)
    {
        if(!$entity instanceof Game) { return; }

        $warGame = $entity->getWarGame();
        if(!$warGame) {  return ; }

		$warGame->updateTeamScores();
		$this->em->persist($warGame);
		$this->uow->computeChangeSet($this->em->getClassMetadata('IHQS\NuitBlancheBundle\Entity\WarGame'), $warGame);
	}
}