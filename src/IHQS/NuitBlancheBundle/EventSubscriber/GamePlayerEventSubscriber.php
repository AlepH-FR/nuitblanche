<?php

namespace IHQS\NuitBlancheBundle\EventSubscriber;

use IHQS\NuitBlancheBundle\Entity\GamePlayer;
use IHQS\NuitBlancheBundle\Entity\Player;

class GamePlayerEventSubscriber extends BaseEventSubscriber
{
    public function updateEntity($entity)
    {
        if($entity instanceof GamePlayer)
        {
            $player = $this->em->getRepository('IHQS\NuitBlancheBundle\Entity\Player')->findOneBySc2Account($entity->getName());
            if($player)
            {
                $entity->setName($entity->getName());
                $entity->setPlayer($player);
                $this->em->persist($entity);
                $this->uow->computeChangeSet($this->em->getClassMetadata('IHQS\NuitBlancheBundle\Entity\GamePlayer'), $entity);
            }
        }
    }
}