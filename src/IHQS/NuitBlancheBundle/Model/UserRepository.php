<?php

namespace IHQS\NuitBlancheBundle\Model;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    public function loadUserByUsername($username)
    {
        // do whatever you need to retrieve the user from the database
        // code below is the implementation used when using the property setting

        return $this->findOneBy(array('username' => $username));
    }

    public function findConnected()
    {
        $limit = date('Y-m-d H:i:s', mktime(date('H'), date('i')-10, date('s'), date('m'), date('d'), date('Y'))) ;

        $qb = $this->createQueryBuilder('u');

        return $qb
            ->where(
                $qb->expr()->gte('u.lastActivity', $qb->expr()->literal($limit))
            )
            ->orderBy('u.lastActivity', 'DESC')
            ->getQuery()->execute();
    }
}