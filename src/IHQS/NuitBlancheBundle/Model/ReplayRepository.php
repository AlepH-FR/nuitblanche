<?php

namespace IHQS\NuitBlancheBundle\Model;

use Doctrine\ORM\EntityRepository;

/**
 * ReplayRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReplayRepository extends EntityRepository
{
    public function findLatest()
    {
        return $this->createQueryBuilder('r')->
            orderBy('r.id', 'DESC')->
            setMaxResults(5)->
            getQuery()->
            execute();
    }
}