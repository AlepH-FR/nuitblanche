<?php

namespace IHQS\NuitBlancheBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use IHQS\NuitBlancheBundle\DataFixtures\BaseFixturesData;
use IHQS\NuitBlancheBundle\Entity\League;

class LoadLeagueData extends BaseFixturesData implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 4;
    }

    public function doLoad()
    {
        $leagues = array();

        // Leagues
        $o = new League();
        $o->setCountry('EU');
        $o->setName('Friendly');
        $leagues['friendly'] = $o;

        $o = new League();
        $o->setCountry('FR');
        $o->setName('Pandaria');
        $leagues['pandaria'] = $o;

        $o = new League();
        $o->setCountry('EU');
        $o->setName('SC2CL');
        $leagues['sc2cl'] = $o;

        $o = new League();
        $o->setCountry('FR');
        $o->setName('SC2F');
        $leagues['sc2f'] = $o;

        $this->registerObjects('league', $leagues);
    }
}