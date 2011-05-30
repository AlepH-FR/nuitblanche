<?php

namespace IHQS\NuitBlancheBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use IHQS\NuitBlancheBundle\DataFixtures\BaseFixturesData;
use IHQS\NuitBlancheBundle\Entity\Season;

class LoadSeasonData extends BaseFixturesData implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 5;
    }

    public function doLoad()
    {
		$seasons = array();

        // Seasons
        $o = new Season();
        $o->setDivision(0);
        $o->setLeague($this->getReference('league:friendly'));
        $o->setNumber(0);
        $o->setStartDate(new \Datetime('2010-09-01 00:00:00'));
        $o->setEnded(false);
        $seasons['friendly_0'] = $o;

        $o = new Season();
        $o->setDivision(3);
        $o->setLeague($this->getReference('league:pandaria'));
        $o->setNumber(1);
        $o->setPosition(1);
        $o->setStartDate(new \Datetime('2010-09-19 00:00:00'));
        $o->setEndDate(new \Datetime('2010-11-14 00:00:00'));
        $o->setEnded(true);
        $seasons['pandaria_1'] = $o;

        $o = new Season();
        $o->setDivision('5e');
        $o->setLeague($this->getReference('league:sc2cl'));
        $o->setNumber(1);
        $o->setPosition(2);
        $o->setStartDate(new \Datetime('2010-09-26 00:00:00'));
        $o->setEndDate(new \Datetime('2010-11-31 00:00:00'));
        $o->setEnded(true);
        $seasons['sc2cl_1'] = $o;

        $o = new Season();
        $o->setDivision('1');
        $o->setLeague($this->getReference('league:sc2f'));
        $o->setNumber(1);
        $o->setPosition(3);
        $o->setStartDate(new \Datetime('2010-11-28 00:00:00'));
        $o->setEndDate(new \Datetime('2011-01-23 00:00:00'));
        $o->setEnded(true);
        $seasons['sc2f_1'] = $o;

        $o = new Season();
        $o->setDivision('3b');
        $o->setLeague($this->getReference('league:sc2cl'));
        $o->setNumber(2);
        $o->setStartDate(new \Datetime('2011-04-10 00:00:00'));
        $o->setEndDate(new \Datetime('2011-06-27 00:00:00'));
        $o->setEnded(false);
        $seasons['sc2cl_2'] = $o;

        $o = new Season();
        $o->setDivision(3);
        $o->setLeague($this->getReference('league:pandaria'));
        $o->setNumber(2);
        $o->setStartDate(new \Datetime('2011-04-24 00:00:00'));
        $o->setEndDate(new \Datetime('2011-07-03 00:00:00'));
        $o->setEnded(false);
        $seasons['pandaria_2'] = $o;

        $this->registerObjects('season', $seasons);
    }
}