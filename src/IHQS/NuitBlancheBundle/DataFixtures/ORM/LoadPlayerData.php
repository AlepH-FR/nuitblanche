<?php

namespace IHQS\NuitBlancheBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use IHQS\NuitBlancheBundle\DataFixtures\BaseFixturesData;
use IHQS\NuitBlancheBundle\Entity\Player;
use IHQS\NuitBlancheBundle\Entity\User;

class LoadPlayerData extends BaseFixturesData implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 1;
    }

    public function doLoad()
    {
		$data = array();
		
        // AlepH
        $user = new User();
        $user->setUsername('AlepH');
        $user->setPassword('aberranger96pass');
        $user->setFirstName('Antoine');
        $user->setLastName('Berranger');
        $user->setCity('Nantes');
        $user->setCountry('France');
        $user->setTwitter('AlepH-FR');
        $user->setSkype('aleph_44');
        $user->setEmail('lysimaque@gmail.com');
        $user->setMsn('lysimaque@hotmail.com');

        $o = new Player();
        $o->setUser($user);
        $o->setSc2Role('Admin');
        $o->setSc2Account('AlepH');
        $o->setSc2Id('372');
        $o->setSc2Race(Player::SC2RACE_RANDOM);
        $o->setSc2ProfileEsl('5335303');
        $o->setSc2ProfileSc2cl('513123');
        $o->setSc2ProfilePandaria('AlepH_FR');
        $data['AlepH'] = $o;

        // Fzero
        $user = new User();
        $user->setUsername('Fzero');
        $user->setPassword('aledez96pass');
        $user->setFirstName('Anthony');
        $user->setLastName('Ledez');
        $user->setCity('Boulogne sur Mer');
        $user->setCountry('France');
        $user->setTwitter('');
        $user->setSkype('');
        $user->setEmail('nbfzero@hotmail.com');
        $user->setMsn('nbfzero@hotmail.com');

        $o = new Player();
        $o->setUser($user);
        $o->setSc2Role('Admin');
        $o->setSc2Account('nBFzero');
        $o->setSc2Id('707');
        $o->setSc2Race(Player::SC2RACE_TERRAN);
        $o->setSc2ProfileEsl('5335381');
        $o->setSc2ProfileSc2cl('351610');
        $o->setSc2ProfilePandaria('NbFzero');
        $data['Fzero'] = $o;

        // loveeyes
        $user = new User();
        $user->setUsername('loveeyes');
        $user->setPassword('rnyman96pass');
        $user->setFirstName('Robert');
        $user->setLastName('Nyman');
        $user->setCity('');
        $user->setCountry('Finland');
        $user->setTwitter('');
        $user->setSkype('');
        $user->setEmail('nyman_84@hotmail.com');
        $user->setMsn('nyman_84@hotmail.com');

        $o = new Player();
        $o->setUser($user);
        $o->setSc2Role('Admin');
        $o->setSc2Account('loveeyes');
        $o->setSc2Id('226');
        $o->setSc2Race(Player::SC2RACE_ZERG);
        $o->setSc2ProfileEsl('5337702');
        $o->setSc2ProfileSc2cl('513333');
        $o->setSc2ProfilePandaria('loveeyes.226');
        $data['loveeyes'] = $o;
		
        $this->registerObjects('player', $data);
    }
}