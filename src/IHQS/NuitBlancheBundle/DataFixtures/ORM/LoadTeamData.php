<?php

namespace IHQS\NuitBlancheBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use IHQS\NuitBlancheBundle\DataFixtures\BaseFixturesData;
use IHQS\NuitBlancheBundle\Entity\Team;

class LoadTeamData extends BaseFixturesData implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 2;
    }

    public function doLoad()
    {
        $data = array();

        $o = new Team();
        $o->setTag('nB)');
        $o->setName('nB.SC2');
        $o->setIcon('/bundles/ihqsnuitblanche/images/ico/nb_boy.png');
        $o->addPlayer($this->getReference('player:AlepH'));
        $o->addPlayer($this->getReference('player:Fzero'));
        $o->addPlayer($this->getReference('player:loveeyes'));
        $data['nB.SC2'] = $o;

        $o = new Team();
        $o->setTag('nB)');
        $o->setName('nB.SC2 Ladies');
        $o->setIcon('/bundles/ihqsnuitblanche/images/ico/nb_girl.png');
        $data['nB.SC2 Ladies'] = $o;

        $o = new Team();
        $o->setTag('nB)');
        $o->setName('nB.SC2 Oldies');
        $o->setIcon('/bundles/ihqsnuitblanche/images/ico/nb_boy.png');
        $data['nB.SC2 Oldies'] = $o;

        $this->registerObjects('team', $data);
    }
}