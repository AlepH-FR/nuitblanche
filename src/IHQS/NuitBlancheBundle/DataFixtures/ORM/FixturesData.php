<?php

namespace IHQS\NuitBlancheBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use IHQS\NuitBlancheBundle\DataFixtures\BaseFixturesData;

use IHQS\NuitBlancheBundle\Entity\Comment;
use IHQS\NuitBlancheBundle\Entity\Game;
use IHQS\NuitBlancheBundle\Entity\GamePlayer;
use IHQS\NuitBlancheBundle\Entity\League;
use IHQS\NuitBlancheBundle\Entity\News;
use IHQS\NuitBlancheBundle\Entity\Player;
use IHQS\NuitBlancheBundle\Entity\Replay;
use IHQS\NuitBlancheBundle\Entity\Season;
use IHQS\NuitBlancheBundle\Entity\Team;
use IHQS\NuitBlancheBundle\Entity\User;
use IHQS\NuitBlancheBundle\Entity\War;
use IHQS\NuitBlancheBundle\Entity\WarGame;

class FixturesData extends BaseFixturesData implements FixtureInterface
{
    public function load($manager)
    {
        $this->manager = $manager;
		
        $this->createPlayers();
        $this->createTeams();
        $this->createNews();
        $this->createLeagues();
        $this->createWars();

        $this->persistAll($manager);
        $manager->flush();
    }

    public function createPlayers()
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

        $this->registerObjects('player', $data);

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

    public function createTeams()
    {
        $data = array();

        $o = new Team();
        $o->setTag('nB)');
        $o->setName('nB.SC2');
        $o->setIcon('/bundles/ihqsnuitblanche/images/ico/nb_boy.png');
        $o->addPlayer($this->objects['player']['AlepH']);
        $o->addPlayer($this->objects['player']['Fzero']);
        $o->addPlayer($this->objects['player']['loveeyes']);
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

    public function createNews()
    {
        $data = array();

        $o = new News();
        $o->setAuthor($this->objects['player']['AlepH']->getUser());
        $o->setDate(new \Datetime());
        $o->setTeam($this->objects['team']['nB.SC2']);
        $o->setTitle('Welcome on brand new nB) website !');
        $o->setBody("
            <p>
                    <strong>Welcome on our new website !</strong>
            </p>
            <p>
                    Nuit Blanche is quite an old team. We are playing like crazy since 1996 and let's guess we are geek enough to continue to play for decades.
                    Since 1996, we made MANY websites. Four versions with various success were made on the collector url <em>clannb.quakexpert.com</em>. Then when StarCraft 2 opened, we quickly created a small website
                    on <em>egame-star</em>.
            </p>
            <p>
                    But none of them was good enough for our exceptionnal team !<br />
                    So I decided to build a brand new one based on new powerful tools : Symfony 2, Doctrine 2 with some extra magical dust.
            </p>
            <p>
                    Here is a list of functions i hope you'll enjoy :
            </p>
            <ul>
                    <li>leagues and seasons recaps</li>
                    <li>detailled clan war page with related replays</li>
                    <li>detailled profiles with statistics, clan war games and replays related</li>
                    <li>cute replay page with apm chart, chat log and more</li>
                    <li>embedded stream pages, with live stream, show history, ...</li>
                    <li>... and more you'll discover while browsing this website</li>
            </ul>
            <p>
                    But we are still in a <strong>v0.9 beta version</strong> !<br />
                    Until the end of the summer, I'll add more cool stuff :
            </p>
            <ul>
                    <li>forum</li>
                    <li>replay notes and comments</li>
                    <li>internationalization for french only speakers (they suck I know !)</li>
            </ul>
            <p>
                    So..... I really hope you'll enjoy that shit and that you'll help us making it an active website.<br />
                    <em>Stay tuned</em>,<br />
                    AlepH
            </p>
        ");
        $data['news_1'] = $o;

        $this->registerObjects('news', $data);

        $data = array();

        $o = new Comment();
        $o->setAuthor($this->objects['player']['AlepH']->getUser());
        $o->setDate(new \Datetime());
        $o->setNews($this->objects['news']['news_1']);
        $o->setBody('And fill free to add some comments !');
        $data['comment_1'] = $o;

        $this->registerObjects('comments', $data);
    }

    public function createLeagues()
    {
        $leagues = array();
        $seasons = array();

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

        // Seasons
        $o = new Season();
        $o->setDivision(0);
        $o->setLeague($leagues['friendly']);
        $o->setNumber(0);
        $o->setStartDate(new \Datetime('2010-09-01 00:00:00'));
        $o->setEnded(false);
        $seasons['friendly_0'] = $o;

        $o = new Season();
        $o->setDivision(3);
        $o->setLeague($leagues['pandaria']);
        $o->setNumber(1);
        $o->setPosition(1);
        $o->setStartDate(new \Datetime('2010-09-19 00:00:00'));
        $o->setEndDate(new \Datetime('2010-11-14 00:00:00'));
        $o->setEnded(true);
        $seasons['pandaria_1'] = $o;

        $o = new Season();
        $o->setDivision('5e');
        $o->setLeague($leagues['sc2cl']);
        $o->setNumber(1);
        $o->setPosition(2);
        $o->setStartDate(new \Datetime('2010-09-26 00:00:00'));
        $o->setEndDate(new \Datetime('2010-11-31 00:00:00'));
        $o->setEnded(true);
        $seasons['sc2cl_1'] = $o;

        $o = new Season();
        $o->setDivision('1');
        $o->setLeague($leagues['sc2f']);
        $o->setNumber(1);
        $o->setPosition(3);
        $o->setStartDate(new \Datetime('2010-11-28 00:00:00'));
        $o->setEndDate(new \Datetime('2011-01-23 00:00:00'));
        $o->setEnded(true);
        $seasons['sc2f_1'] = $o;

        $o = new Season();
        $o->setDivision('3b');
        $o->setLeague($leagues['sc2cl']);
        $o->setNumber(2);
        $o->setStartDate(new \Datetime('2011-04-10 00:00:00'));
        $o->setEndDate(new \Datetime('2011-06-27 00:00:00'));
        $o->setEnded(false);
        $seasons['sc2cl_2'] = $o;

        $o = new Season();
        $o->setDivision(3);
        $o->setLeague($leagues['pandaria']);
        $o->setNumber(2);
        $o->setStartDate(new \Datetime('2011-04-24 00:00:00'));
        $o->setEndDate(new \Datetime('2011-07-03 00:00:00'));
        $o->setEnded(false);
        $seasons['pandaria_2'] = $o;

        $this->registerObjects('leagues', $leagues);
        $this->registerObjects('seasons', $seasons);
    }

    public function createWars()
    {
        // Friendly
        $wars = array(
            0 => array(
                "war"	=> array(3, 5, 'NJ',		'FR', new \Datetime('2010-09-06 21:00:00')),
                "games"	=> array(
                    array(1, 2, array("loveeyes" => Player::SC2RACE_TERRAN),	array("KayO" => Player::SC2RACE_PROTOSS)),
                    array(2, 1, array("Clafter" => Player::SC2RACE_TERRAN),		array("deco" => Player::SC2RACE_PROTOSS)),
                    array(0, 2, array("AlepH" => Player::SC2RACE_PROTOSS),		array("m00nty" => Player::SC2RACE_PROTOSS)),
                    array(2, 1, array("Naudar" => Player::SC2RACE_RANDOM),		array("Inside" => Player::SC2RACE_PROTOSS)),
                    array(2, 1, array("YoPYoP" => Player::SC2RACE_PROTOSS),		array("Chemist" => Player::SC2RACE_TERRAN)),
                    array(0, 2, array("HammeR" => Player::SC2RACE_RANDOM),		array("Naoned" => Player::SC2RACE_RANDOM)),
                    array(0, 2, array("Clafter" => Player::SC2RACE_TERRAN, "loveeyes" => Player::SC2RACE_TERRAN),	array("deco" => Player::SC2RACE_PROTOSS, "Naoned" => Player::SC2RACE_ZERG)),
                    array(0, 2, array("Acid" => Player::SC2RACE_PROTOSS, "HammeR" => Player::SC2RACE_RANDOM),		array("Amaley" => Player::SC2RACE_RANDOM, "Inside" => Player::SC2RACE_RANDOM)),
                )
            ),

            1 => array(
                "war"	=> array(2, 3, '3D',		'FR', new \Datetime('2010-09-10 21:00:00')),
                "games"	=> array(
                    array(2, 1, array("MttN" => Player::SC2RACE_TERRAN),		array("nAm" => Player::SC2RACE_PROTOSS)),
                    array(0, 2, array("loveeyes" => Player::SC2RACE_TERRAN),	array("Crappy" => Player::SC2RACE_PROTOSS)),
                    array(1, 2, array("BaGhLa" => Player::SC2RACE_TERRAN),		array("Zwey" => Player::SC2RACE_PROTOSS)),
                    array(0, 2, array("Kura" => Player::SC2RACE_TERRAN),		array("NaSh" => Player::SC2RACE_RANDOM)),
                    array(2, 1, array("BaGhLa" => Player::SC2RACE_TERRAN, "Kura" => Player::SC2RACE_ZERG), array("nAm" => Player::SC2RACE_PROTOSS, "NaSh" => Player::SC2RACE_TERRAN)),
                )
            ),

            2 => array(
                "war"	=> array(3, 5, 'FOX',		'FR', new \Datetime('2010-09-17 21:00:00')),
                "games"	=> array(
                    array(2, 0, array("loveeyes" => Player::SC2RACE_TERRAN),	array("SaJa" => Player::SC2RACE_PROTOSS)),
                    array(2, 0, array("MttN" => Player::SC2RACE_TERRAN),		array("ZerGo" => Player::SC2RACE_ZERG)),
                    array(0, 2, array("Kura" => Player::SC2RACE_TERRAN),		array("Jim" => Player::SC2RACE_TERRAN)),
                    array(0, 2, array("HammeR" => Player::SC2RACE_RANDOM),		array("HaN" => Player::SC2RACE_RANDOM)),
                    array(0, 2, array("Acid" => Player::SC2RACE_PROTOSS),		array("Osgiliath" => Player::SC2RACE_ZERG)),
                    array(0, 2, array("AlepH" => Player::SC2RACE_PROTOSS),		array("DaRa" => Player::SC2RACE_PROTOSS)),
                    array(2, 1, array("MttN" => Player::SC2RACE_TERRAN, "Kura" => Player::SC2RACE_ZERG),			array("DaRa" => Player::SC2RACE_PROTOSS, "Jim" => Player::SC2RACE_TERRAN)),
                    array(0, 2, array("loveeyes" => Player::SC2RACE_TERRAN, "AlepH" => Player::SC2RACE_PROTOSS),	array("HaN" => Player::SC2RACE_ZERG, "PiVoR" => Player::SC2RACE_TERRAN)),
                )
            ),

            3 => array(
                "war"	=> array(3, 2, 'SN',		'FR', new \Datetime('2011-01-30 21:00:00')),
                "games"	=> array(
                    array(2, 1, array("Lunatic" => Player::SC2RACE_TERRAN),		array("RenZaN" => Player::SC2RACE_ZERG)),
                    array(2, 0, array("MttN" => Player::SC2RACE_TERRAN),		array("BOMBER" => Player::SC2RACE_PROTOSS)),
                    array(1, 2, array("swArm" => Player::SC2RACE_TERRAN),		array("GKCDQ" => Player::SC2RACE_PROTOSS)),
                    array(1, 2, array("Whiteman" => Player::SC2RACE_TERRAN),	array("Ktn" => Player::SC2RACE_RANDOM)),
                    array(2, 0, array("mYst" => Player::SC2RACE_RANDOM),		array("Wrath" => Player::SC2RACE_PROTOSS)),
                )
            ),

            4 => array(
                "war"	=> array(3, 4, 'FOX',		'FR', new \Datetime('2011-02-06 21:00:00')),
                "games"	=> array(
                    array(0, 2, array("BaGhLa" => Player::SC2RACE_TERRAN),		array("MetalMaster" => Player::SC2RACE_ZERG)),
                    array(1, 2, array("Lunatic" => Player::SC2RACE_TERRAN),		array("sMiLe" => Player::SC2RACE_ZERG)),
                    array(2, 0, array("MttN" => Player::SC2RACE_TERRAN),		array("Foumiz" => Player::SC2RACE_PROTOSS)),
                    array(2, 1, array("mYst" => Player::SC2RACE_RANDOM),		array("jakilau" => Player::SC2RACE_TERRAN)),
                    array(0, 2, array("Milla" => Player::SC2RACE_PROTOSS),		array("SalSal" => Player::SC2RACE_TERRAN)),
                    array(2, 1, array("MttN" => Player::SC2RACE_TERRAN, "mYst" => Player::SC2RACE_RANDOM),			array("HaN" => Player::SC2RACE_ZERG, "PiVoR" => Player::SC2RACE_TERRAN)),
                    array(0, 2, array("Bouh" => Player::SC2RACE_PROTOSS, "Lapin" => Player::SC2RACE_ZERG),	array("DaRa" => Player::SC2RACE_PROTOSS, "boyyy" => Player::SC2RACE_ZERG)),
                )
            ),

            5 => array(
                "war"	=> array(3, 2, 'FOX',		'FR', new \Datetime('2011-02-13 21:00:00')),
                "games"	=> array(
                    array(2, 0, array("MttN" => Player::SC2RACE_TERRAN),		array("MetalMaster" => Player::SC2RACE_ZERG)),
                    array(2, 0, array("Bouh" => Player::SC2RACE_PROTOSS),		array("boyyy" => Player::SC2RACE_ZERG)),
                    array(0, 2, array("Lunatic" => Player::SC2RACE_TERRAN),		array("jakilau" => Player::SC2RACE_TERRAN)),
                    array(0, 2, array("Clafter" => Player::SC2RACE_TERRAN),		array("Foumiz" => Player::SC2RACE_PROTOSS)),
                    array(2, 0, array("Clafter" => Player::SC2RACE_PROTOSS, "BattleStad" => Player::SC2RACE_ZERG),	array("DaRa" => Player::SC2RACE_PROTOSS, "boyyy" => Player::SC2RACE_ZERG)),
                )
            ),
        );
        $this->processLeagueWars('friendly_0', $wars);

        // Pandaria Saison 1
        $wars = array(
            0 => array(
                "war"	=> array(5, 0, 'NbT',		'FR', new \Datetime('2010-09-19 21:00:00')),
                "games"	=> array(
                    array(2, 1, array("Kura" => Player::SC2RACE_TERRAN),	array("yanhamu" => Player::SC2RACE_PROTOSS)),
                    array(2, 0, array("BaGhLa" => Player::SC2RACE_TERRAN),	array("SyDe" => Player::SC2RACE_TERRAN)),
                    array(2, 0, array("MttN" => Player::SC2RACE_TERRAN),	array("HPrime" => Player::SC2RACE_TERRAN)),
                    array(2, 0, array("Clafter" => Player::SC2RACE_TERRAN),	array("Spaylz" => Player::SC2RACE_PROTOSS)),
                    array(2, 0, array("BaGhLa" => Player::SC2RACE_TERRAN, "Kura" => Player::SC2RACE_ZERG), array("SyDe" => Player::SC2RACE_TERRAN, "Spaylz" => Player::SC2RACE_PROTOSS)),
                )
            ),

            1 => array(
                "war"	=> array(3, 2, 'aW',		'FR', new \Datetime('2010-09-26 21:00:00')),
                "games"	=> array(
                    array(2, 0, array("BaGhLa" => Player::SC2RACE_TERRAN),		array("Wallen" => Player::SC2RACE_ZERG)),
                    array(1, 2, array("RaptorS" => Player::SC2RACE_PROTOSS),	array("Khoral" => Player::SC2RACE_TERRAN)),
                    array(1, 2, array("nBSpOoN" => Player::SC2RACE_PROTOSS),	array("AvenGeR" => Player::SC2RACE_PROTOSS)),
                    array(2, 0, array("YoPYoP" => Player::SC2RACE_PROTOSS),		array("AjiRa" => Player::SC2RACE_ZERG)),
                    array(2, 0, array("BaGhLa" => Player::SC2RACE_TERRAN, "Kura" => Player::SC2RACE_ZERG), array("AvenGeR" => Player::SC2RACE_PROTOSS, "AjiRa" => Player::SC2RACE_ZERG)),
                )
            ),

            2 => array(
                "war"	=> array(2, 3, 'JPFF',	'FR', new \Datetime('2010-10-03 21:00:00')),
                "games"	=> array(
                    array(0, 2, array("BaGhLa" => Player::SC2RACE_TERRAN),		array("Sweety" => Player::SC2RACE_PROTOSS)),
                    array(0, 2, array("loveeyes" => Player::SC2RACE_TERRAN),		array("Rasmuth" => Player::SC2RACE_PROTOSS)),
                    array(2, 0, array("MttN" => Player::SC2RACE_TERRAN),		array("Sangui" => Player::SC2RACE_ZERG)),
                    array(2, 0, array("Clafter" => Player::SC2RACE_TERRAN),		array("Tartiflette" => Player::SC2RACE_TERRAN)),
                    array(0, 2, array("BaGhLa" => Player::SC2RACE_TERRAN, "Kura" => Player::SC2RACE_ZERG), array("Sweety" => Player::SC2RACE_PROTOSS, "Sangui" => Player::SC2RACE_ZERG)),
                )
            ),

            3 => array(
                "war"	=> array(3, 2, 'FOX',		'FR', new \Datetime('2010-10-08 21:00:00')),
                "games"	=> array(
                    array(0, 2, array("BaGhLa" => Player::SC2RACE_TERRAN),		array("Jim" => Player::SC2RACE_TERRAN)),
                    array(2, 0, array("MttN" => Player::SC2RACE_TERRAN),		array("ZerGo" => Player::SC2RACE_ZERG)),
                    array(2, 0, array("YoPYoP" => Player::SC2RACE_PROTOSS),		array("jerome" => Player::SC2RACE_PROTOSS)),
                    array(2, 0, array("Clafter" => Player::SC2RACE_TERRAN),		array("Osgiliath" => Player::SC2RACE_ZERG)),
                    array(0, 2, array("BaGhLa" => Player::SC2RACE_TERRAN, "Kura" => Player::SC2RACE_ZERG), array("Han" => Player::SC2RACE_PROTOSS, "PiVoR" => Player::SC2RACE_TERRAN)),
                )
            ),

            4 => array(
                "war"	=> array(5, 0, 'MoX',		'FR', new \Datetime('2010-10-17 21:00:00')),
                "games"	=> array(
                    array(2, 0, array("BaGhLa" => Player::SC2RACE_TERRAN),		array("Tevou" => Player::SC2RACE_TERRAN)),
                    array(2, 0, array("MttN" => Player::SC2RACE_TERRAN),		array("Fyl" => Player::SC2RACE_ZERG)),
                    array(2, 0, array("loveeyes" => Player::SC2RACE_TERRAN),	array("ChrisC" => Player::SC2RACE_TERRAN)),
                    array(2, 1, array("nBLiO" => Player::SC2RACE_ZERG),			array("sendozzz" => Player::SC2RACE_PROTOSS)),
                    array(2, 0, array("loveeyes" => Player::SC2RACE_TERRAN, "MttN" => Player::SC2RACE_TERRAN), array("sendozzz" => Player::SC2RACE_PROTOSS, "ChrisC" => Player::SC2RACE_TERRAN)),
                )
            ),

            5 => array(
                "war"	=> array(2, 3, 'AdC',		'FR', new \Datetime('2010-10-24 21:00:00')),
                "games"	=> array(
                    array(0, 2, array("MttN" => Player::SC2RACE_TERRAN),		array("Zym" => Player::SC2RACE_PROTOSS)),
                    array(1, 2, array("loveeyes" => Player::SC2RACE_TERRAN),	array("Fyl" => Player::SC2RACE_TERRAN)),
                    array(2, 1, array("Clafter" => Player::SC2RACE_TERRAN),		array("MaSteR" => Player::SC2RACE_PROTOSS)),
                    array(1, 2, array("Naudar" => Player::SC2RACE_RANDOM),		array("MysTfaN" => Player::SC2RACE_PROTOSS)),
                    array(2, 0, array("loveeyes" => Player::SC2RACE_TERRAN, "Clafter" => Player::SC2RACE_TERRAN), array("NewEra" => Player::SC2RACE_PROTOSS, "Heaven" => Player::SC2RACE_ZERG)),
                )
            ),
            6 => array(
                "war"	=> array(5, 0, 'BriT',	'FR', new \Datetime('2010-11-01 21:00:00')),
                "games"	=> array(
                    array(2, 0, array("MttN" => Player::SC2RACE_TERRAN),		array("Oseam" => Player::SC2RACE_PROTOSS)),
                    array(2, 0, array("loveeyes" => Player::SC2RACE_TERRAN),	array("Madman" => Player::SC2RACE_TERRAN)),
                    array(2, 0, array("Clafter" => Player::SC2RACE_TERRAN),		array("Raymonde" => Player::SC2RACE_TERRAN)),
                    array(2, 0, array("mYst" => Player::SC2RACE_RANDOM),		array("Zeuhl" => Player::SC2RACE_PROTOSS)),
                    array(2, 0, array("loveeyes" => Player::SC2RACE_TERRAN, "Clafter" => Player::SC2RACE_TERRAN), array("Thad" => Player::SC2RACE_PROTOSS, "Seno" => Player::SC2RACE_TERRAN)),
                )

            ),
            7 => array(
                "war"	=> array(4, 1, 'Fae',		'BE', new \Datetime('2010-11-07 21:00:00')),
                "games"	=> array(
                    array(2, 1, array("Clafter" => Player::SC2RACE_TERRAN),		array("Eboceixa" => Player::SC2RACE_PROTOSS)),
                    array(2, 0, array("loveeyes" => Player::SC2RACE_TERRAN),	array("BEPChomage" => Player::SC2RACE_ZERG)),
                    array(0, 2, array("MttN" => Player::SC2RACE_TERRAN),		array("niilzon" => Player::SC2RACE_PROTOSS)),
                    array(2, 0, array("Pepem" => Player::SC2RACE_ZERG),			array("Taupinambour" => Player::SC2RACE_TERRAN)),
                    array(2, 0, array("loveeyes" => Player::SC2RACE_TERRAN, "MttN" => Player::SC2RACE_TERRAN), array("niilzon" => Player::SC2RACE_PROTOSS, "Oodgeroo" => Player::SC2RACE_ZERG)),
                )

            ),

            8 => array(
                "war"	=> array(3, 2, 'RCA',		'FR', new \Datetime('2010-11-14 21:00:00')),
                "games"	=> array(
                    array(2, 0, array("Clafter" => Player::SC2RACE_TERRAN),		array("Rowa" => Player::SC2RACE_TERRAN)),
                    array(1, 2, array("loveeyes" => Player::SC2RACE_TERRAN),	array("GGs" => Player::SC2RACE_TERRAN)),
                    array(2, 0, array("MttN" => Player::SC2RACE_TERRAN),		array("Kanon" => Player::SC2RACE_TERRAN)),
                    array(1, 2, array("Pepem" => Player::SC2RACE_ZERG),			array("Foumiz" => Player::SC2RACE_PROTOSS)),
                    array(2, 0, array("loveeyes" => Player::SC2RACE_TERRAN, "Clafter" => Player::SC2RACE_TERRAN), array("Foumiz" => Player::SC2RACE_PROTOSS, "GGs" => Player::SC2RACE_TERRAN)),
                )
            ),
        );
        $this->processLeagueWars('pandaria_1', $wars);

        // SC2CL Saison 1
        $wars = array(
                0 => array(
                        "war"	=> array(3, 3, 'nuBreed',		'DE', new \Datetime('2010-09-26 19:00:00')),
                        "games"	=> array(
                                array(1, 2, array("MttN" => Player::SC2RACE_TERRAN),		array("Tempest" => Player::SC2RACE_PROTOSS)),
                                array(0, 2, array("loveeyes" => Player::SC2RACE_TERRAN),	array("Shizanu" => Player::SC2RACE_ZERG)),
                                array(2, 0, array("Clafter" => Player::SC2RACE_TERRAN),		array("RokuWa" => Player::SC2RACE_TERRAN)),
                                array(1, 2, array("YoPYoP" => Player::SC2RACE_TERRAN),		array("Dexxer" => Player::SC2RACE_PROTOSS)),
                                array(2, 0, array("Clafter" => Player::SC2RACE_TERRAN, "loveeyes" => Player::SC2RACE_TERRAN),	array("Dexxer" => Player::SC2RACE_PROTOSS, "RokuWa" => Player::SC2RACE_TERRAN)),
                                array(2, 0, array("BaGhLa" => Player::SC2RACE_TERRAN, "Kura" => Player::SC2RACE_ZERG),			array("Tempest" => Player::SC2RACE_PROTOSS, "Shizanu" => Player::SC2RACE_ZERG)),
                        )
                ),

                1 => array(
                        "war"	=> array(4, 2, 'nSK',		'DE', new \Datetime('2010-10-03 19:00:00')),
                        "games"	=> array(
                                array(2, 0, array("MttN" => Player::SC2RACE_TERRAN),		array("KyRoN" => Player::SC2RACE_PROTOSS)),
                                array(2, 0, array("loveeyes" => Player::SC2RACE_TERRAN),	array("fiDZz" => Player::SC2RACE_PROTOSS)),
                                array(1, 2, array("Kura" => Player::SC2RACE_TERRAN),		array("OthUnKnown" => Player::SC2RACE_TERRAN)),
                                array(2, 0, array("nBLiO" => Player::SC2RACE_ZERG),			array("Silver" => Player::SC2RACE_TERRAN)),
                                array(1, 2, array("BaGhLa" => Player::SC2RACE_TERRAN, "Kura" => Player::SC2RACE_ZERG),		array("fiDZz" => Player::SC2RACE_PROTOSS, "OthUnKnown" => Player::SC2RACE_TERRAN)),
                                array(2, 0, array("MttN" => Player::SC2RACE_TERRAN, "loveeyes" => Player::SC2RACE_TERRAN),	array("KyRoN" => Player::SC2RACE_PROTOSS, "Silver" => Player::SC2RACE_TERRAN)),
                        )
                ),

                2 => array(
                        "war"	=> array(2, 4, 'GL',		'NO', new \Datetime('2010-10-10 19:00:00')),
                        "games"	=> array(
                                array(2, 0, array("Clafter" => Player::SC2RACE_TERRAN),		array("Thorgrim" => Player::SC2RACE_TERRAN)),
                                array(0, 2, array("BaGhLa" => Player::SC2RACE_TERRAN),		array("Erlingho" => Player::SC2RACE_TERRAN)),
                                array(0, 2, array("RaptorS" => Player::SC2RACE_PROTOSS),	array("Meltzy" => Player::SC2RACE_ZERG)),
                                array(1, 2, array("Kura" => Player::SC2RACE_TERRAN),		array("Richy" => Player::SC2RACE_PROTOSS)),
                                array(2, 0, array("Clafter" => Player::SC2RACE_TERRAN, "loveeyes" => Player::SC2RACE_TERRAN),	array("Metalon" => Player::SC2RACE_PROTOSS, "Meltzy" => Player::SC2RACE_ZERG)),
                                array(0, 2, array("BaGhLa" => Player::SC2RACE_TERRAN, "Kura" => Player::SC2RACE_ZERG),			array("Richy" => Player::SC2RACE_PROTOSS, "Knutzy" => Player::SC2RACE_PROTOSS)),
                        )
                ),

                3 => array(
                        "war"	=> array(6, 0, 'Baby',		'DE', new \Datetime('2010-10-17 19:00:00')),
                        "games"	=> array(
                                array(2, 0, array("Pepem" => Player::SC2RACE_ZERG),			array("Newman" => Player::SC2RACE_TERRAN)),
                                array(2, 1, array("loveeyes" => Player::SC2RACE_TERRAN),	array("Gremlino" => Player::SC2RACE_TERRAN)),
                                array(2, 0, array("nBLiO" => Player::SC2RACE_ZERG),			array("nae" => Player::SC2RACE_PROTOSS)),
                                array(2, 0, array("Kura" => Player::SC2RACE_RANDOM),		array("Wuuuuwup" => Player::SC2RACE_TERRAN)),
                                array(2, 0, array("nBLiO" => Player::SC2RACE_ZERG, "Kura" => Player::SC2RACE_TERRAN),	array("nae" => Player::SC2RACE_PROTOSS, "Gremlino" => Player::SC2RACE_TERRAN)),
                                array(2, 0, array("mYst" => Player::SC2RACE_RANDOM, "Acid" => Player::SC2RACE_PROTOSS),	array("Nuramon" => Player::SC2RACE_PROTOSS, "Newman" => Player::SC2RACE_TERRAN)),
                        )
                ),

                4 => array(
                        "war"	=> array(4, 2, 'dnc',		'DE', new \Datetime('2010-10-31 19:00:00')),
                        "games"	=> array(
                                array(0, 2, array("Acid" => Player::SC2RACE_PROTOSS),		array("EvilRine" => Player::SC2RACE_TERRAN)),
                                array(2, 0, array("loveeyes" => Player::SC2RACE_TERRAN),	array("Sheeperich" => Player::SC2RACE_ZERG)),
                                array(2, 0, array("Clafter" => Player::SC2RACE_TERRAN),		array("selti" => Player::SC2RACE_PROTOSS)),
                                array(2, 0, array("mYst" => Player::SC2RACE_RANDOM),		array("LukeEndMint" => Player::SC2RACE_ZERG)),
                                array(2, 0, array("Clafter" => Player::SC2RACE_TERRAN, "loveeyes" => Player::SC2RACE_TERRAN),	array("Sheeperich" => Player::SC2RACE_ZERG, "LukeEndMint" => Player::SC2RACE_ZERG)),
                                array(0, 2, array("mYst" => Player::SC2RACE_RANDOM, "Acid" => Player::SC2RACE_PROTOSS),			array("EvilRine" => Player::SC2RACE_TERRAN, "SaTe" => Player::SC2RACE_ZERG)),
                        )
                ),
        );
        $this->processLeagueWars('sc2cl_1', $wars);

        // SC2F 1
        $wars = array(
                0 => array(
                        "war"	=> array(0, 3, 'SYPHER',		'BE', new \Datetime('2010-10-04 17:00:00')),
                        "games"	=> array(
                                array(1, 2, array("Clafter" => Player::SC2RACE_TERRAN),		array("Feast" => Player::SC2RACE_PROTOSS)),
                                array(0, 2, array("MttN" => Player::SC2RACE_TERRAN),		array("BeNSeN" => Player::SC2RACE_ZERG)),
                                array(0, 2, array("BaGhLa" => Player::SC2RACE_TERRAN),		array("Cosmos" => Player::SC2RACE_TERRAN)),
                        )
                ),

                1 => array(
                        "war"	=> array(1, 4, 'CN',		'FR', new \Datetime('2010-10-11 17:00:00')),
                        "games"	=> array(
                                array(0, 2, array("MttN" => Player::SC2RACE_TERRAN),		array("Didzz" => Player::SC2RACE_PROTOSS)),
                                array(0, 2, array("Clafter" => Player::SC2RACE_TERRAN),		array("Hysteria" => Player::SC2RACE_ZERG)),
                                array(0, 2, array("YoPYoP" => Player::SC2RACE_PROTOSS),		array("SeaW" => Player::SC2RACE_PROTOSS)),
                                array(2, 1, array("Pepem" => Player::SC2RACE_ZERG),		array("Qwerty" => Player::SC2RACE_ZERG)),
                                array(0, 2, array("Clafter" => Player::SC2RACE_TERRAN, "MttN" => Player::SC2RACE_TERRAN),	array("Didzz" => Player::SC2RACE_PROTOSS, "Qwerty" => Player::SC2RACE_ZERG)),
                        )
                ),

                2 => array(
                        "war"	=> array(3, 2, 'Prod',		'FR', new \Datetime('2010-11-28 17:00:00')),
                        "games"	=> array(
                                array(1, 2, array("Bouh" => Player::SC2RACE_PROTOSS),		array("Arca" => Player::SC2RACE_PROTOSS)),
                                array(2, 0, array("Clafter" => Player::SC2RACE_TERRAN),		array("Velith" => Player::SC2RACE_TERRAN)),
                                array(1, 2, array("beerwithme" => Player::SC2RACE_ZERG),		array("NiFi" => Player::SC2RACE_RANDOM)),
                                array(2, 1, array("Pepem" => Player::SC2RACE_ZERG),		array("JeremGS" => Player::SC2RACE_PROTOSS)),
                                array(2, 0, array("Clafter" => Player::SC2RACE_TERRAN, "loveeyes" => Player::SC2RACE_TERRAN),	array("KoDeNi" => Player::SC2RACE_PROTOSS, "Velith" => Player::SC2RACE_TERRAN)),
                        )
                ),

                3 => array(
                        "war"	=> array(2, 3, '3D',		'FR', new \Datetime('2010-12-06 17:00:00')),
                        "games"	=> array(
                                array(0, 2, array("Bouh" => Player::SC2RACE_PROTOSS),		array("Cosmos" => Player::SC2RACE_TERRAN)),
                                array(2, 1, array("Clafter" => Player::SC2RACE_TERRAN),		array("AbY" => Player::SC2RACE_ZERG)),
                                array(0, 2, array("beerwithme" => Player::SC2RACE_ZERG),	array("BiGuP" => Player::SC2RACE_TERRAN)),
                                array(1, 2, array("Pepem" => Player::SC2RACE_ZERG),			array("MaSter" => Player::SC2RACE_PROTOSS)),
                                array(2, 0, array("Clafter" => Player::SC2RACE_TERRAN, "loveeyes" => Player::SC2RACE_TERRAN), array("AbY" => Player::SC2RACE_ZERG, "Cosmos" => Player::SC2RACE_TERRAN)),
                        )
                ),

                4 => array(
                        "war"	=> array(4, 1, 'MgZ',		'FR', new \Datetime('2010-12-12 17:00:00')),
                        "games"	=> array(
                                array(2, 0, array("Bouh" => Player::SC2RACE_PROTOSS),		array("KeYsEr" => Player::SC2RACE_ZERG)),
                                array(2, 1, array("Clafter" => Player::SC2RACE_TERRAN),		array("ShuttleS" => Player::SC2RACE_ZERG)),
                                array(0, 2, array("Naudar" => Player::SC2RACE_ZERG),		array("Ptak" => Player::SC2RACE_ZERG)),
                                array(2, 0, array("Pepem" => Player::SC2RACE_ZERG),			array("ManneR" => Player::SC2RACE_ZERG)),
                                array(2, 0, array("Clafter" => Player::SC2RACE_TERRAN, "loveeyes" => Player::SC2RACE_TERRAN), array("KeYsEr" => Player::SC2RACE_ZERG, "cymp" => Player::SC2RACE_PROTOSS)),
                        )
                ),

                5 => array(
                        "war"	=> array(4, 1, 'JPFF',		'FR', new \Datetime('2010-12-17 17:00:00')),
                        "games"	=> array(
                                array(2, 1, array("Clafter" => Player::SC2RACE_TERRAN),		array("Rasmuth" => Player::SC2RACE_PROTOSS)),
                                array(2, 0, array("beerwithme" => Player::SC2RACE_ZERG),	array("Sangui" => Player::SC2RACE_ZERG)),
                                array(2, 1, array("Pepem" => Player::SC2RACE_ZERG),			array("Sweety" => Player::SC2RACE_PROTOSS)),
                                array(0, 2, array("Bouh" => Player::SC2RACE_PROTOSS),		array("Tartiflette" => Player::SC2RACE_TERRAN)),
                                array(2, 0, array("Clafter" => Player::SC2RACE_TERRAN, "loveeyes" => Player::SC2RACE_TERRAN), array("Sangui" => Player::SC2RACE_ZERG, "Sweety" => Player::SC2RACE_PROTOSS)),
                        )
                ),

                6 => array(
                        "war"	=> array(3, 2, 'CsT',		'FR', new \Datetime('2011-01-16 17:00:00')),
                        "games"	=> array(
                                array(0, 2, array("beerwithme" => Player::SC2RACE_ZERG),	array("Lidwyn" => Player::SC2RACE_TERRAN)),
                                array(0, 2, array("Clafter" => Player::SC2RACE_TERRAN),		array("Tarki" => Player::SC2RACE_ZERG)),
                                array(2, 0, array("Pepem" => Player::SC2RACE_ZERG),			array("Eeel" => Player::SC2RACE_ZERG)),
                                array(2, 0, array("Bouh" => Player::SC2RACE_PROTOSS),		array("Klusty" => Player::SC2RACE_TERRAN)),
                                array(2, 1, array("Clafter" => Player::SC2RACE_TERRAN, "loveeyes" => Player::SC2RACE_TERRAN), array("Tarki" => Player::SC2RACE_ZERG, "ParadoX" => Player::SC2RACE_PROTOSS)),
                        )
                ),

                7 => array(
                        "war"	=> array(3, 2, 'SN',		'FR', new \Datetime('2011-01-23 17:00:00')),
                        "games"	=> array(
                                array(2, 0, array("Clafter" => Player::SC2RACE_TERRAN),		array("RenZaN" => Player::SC2RACE_ZERG)),
                                array(2, 1, array("Pepem" => Player::SC2RACE_ZERG),			array("iZno" => Player::SC2RACE_TERRAN)),
                                array(0, 2, array("beerwithme" => Player::SC2RACE_ZERG),	array("Moi" => Player::SC2RACE_PROTOSS)),
                                array(2, 1, array("Bouh" => Player::SC2RACE_PROTOSS),		array("BOMBER" => Player::SC2RACE_PROTOSS)),
                                array(0, 2, array("Clafter" => Player::SC2RACE_TERRAN, "loveeyes" => Player::SC2RACE_TERRAN), array("RenZaN" => Player::SC2RACE_ZERG, "iZno" => Player::SC2RACE_TERRAN)),
                        )
                ),

                8 => array(
                        "war"	=> array(1, 4, 'Virus',		'EU', new \Datetime('2011-02-08 17:00:00')),
                        "games"	=> array(
                                array(0, 2, array("MttN" => Player::SC2RACE_TERRAN),		array("Satiini" => Player::SC2RACE_TERRAN)),
                                array(0, 2, array("Bouh" => Player::SC2RACE_PROTOSS),		array("Laukyo" => Player::SC2RACE_TERRAN)),
                                array(0, 2, array("beerwithme" => Player::SC2RACE_ZERG),	array("effecto" => Player::SC2RACE_TERRAN)),
                                array(0, 2, array("Pepem" => Player::SC2RACE_ZERG),			array("Unleashed" => Player::SC2RACE_ZERG)),
                                array(2, 0, array("Pepem" => Player::SC2RACE_ZERG, "mYst" => Player::SC2RACE_RANDOM), array("SonG" => Player::SC2RACE_TERRAN, "XiriS" => Player::SC2RACE_PROTOSS)),
                        )
                ),

                9 => array(
                        "war"	=> array(1, 3, 'Oo',		'FR', new \Datetime('2011-02-20 17:00:00')),
                        "games"	=> array(
                                array(1, 2, array("Clafter" => Player::SC2RACE_TERRAN),		array("Swilice" => Player::SC2RACE_TERRAN)),
                                array(2, 0, array("Bouh" => Player::SC2RACE_PROTOSS),		array("TrynFly" => Player::SC2RACE_TERRAN)),
                                array(0, 2, array("beerwithme" => Player::SC2RACE_ZERG),	array("FooFigther" => Player::SC2RACE_TERRAN)),
                                array(1, 2, array("loveeyes" => Player::SC2RACE_TERRAN, "swArm" => Player::SC2RACE_TERRAN), array("Trynfly" => Player::SC2RACE_TERRAN, "Isaer" => Player::SC2RACE_ZERG)),
                        )
                ),
        );
        $this->processLeagueWars('sc2f_1', $wars);

        // SC2CL 2
        $wars = array(
                0 => array(
                        "war"	=> array(4, 1, 'DoS',		'DE', new \Datetime('2011-04-10 19:00:00')),
                        "games"	=> array(
                                array(2, 1, array("beerwithme" => Player::SC2RACE_ZERG),	array("RuFFy" => Player::SC2RACE_ZERG)),
                                array(2, 0, array("Defwin" => Player::SC2RACE_RANDOM),		array("-" => Player::SC2RACE_RANDOM)),
                                array(1, 2, array("Hane" => Player::SC2RACE_PROTOSS),		array("Talanthalos" => Player::SC2RACE_TERRAN)),
                                array(2, 1, array("Bouh" => Player::SC2RACE_PROTOSS),		array("NosFeraTu" => Player::SC2RACE_ZERG)),
                                array(2, 0, array("Defwin" => Player::SC2RACE_RANDOM, "Defwin" => Player::SC2RACE_RANDOM), array("-" => Player::SC2RACE_RANDOM, "-" => Player::SC2RACE_RANDOM)),
                        )
                ),

                2 => array(
                        "war"	=> array(0, 4, 'eyes',		'DE', new \Datetime('2011-04-24 19:00:00')),
                        "games"	=> array(
                                array(1, 2, array("Bouh" => Player::SC2RACE_PROTOSS),		array("saltthewound" => Player::SC2RACE_ZERG)),
                                array(0, 2, array("Hane" => Player::SC2RACE_PROTOSS),		array("Manking" => Player::SC2RACE_PROTOSS)),
                                array(1, 2, array("MttN" => Player::SC2RACE_TERRAN),		array("OminouS" => Player::SC2RACE_PROTOSS)),
                                array(0, 2, array("WhiteMan" => Player::SC2RACE_RANDOM, "mYst" => Player::SC2RACE_RANDOM), array("darglein" => Player::SC2RACE_RANDOM, "Manking" => Player::SC2RACE_PROTOSS)),
                        )
                ),

                3 => array(
                        "war"	=> array(3, 2, 'oOa',		'DE', new \Datetime('2011-05-01 19:00:00')),
                        "games"	=> array(
                                array(0, 2, array("GsHeeRo" => Player::SC2RACE_ZERG),		array("sAuROn" => Player::SC2RACE_TERRAN)),
                                array(2, 0, array("Defwin" => Player::SC2RACE_RANDOM),		array("-" => Player::SC2RACE_RANDOM)),
                                array(2, 0, array("MttN" => Player::SC2RACE_TERRAN),		array("chillakilla" => Player::SC2RACE_RANDOM)),
                                array(2, 1, array("Hane" => Player::SC2RACE_PROTOSS),		array("Sheeperich" => Player::SC2RACE_ZERG)),
                                array(1, 2, array("paupiette" => Player::SC2RACE_TERRAN, "GsHeeRo" => Player::SC2RACE_ZERG), array("sAuROn" => Player::SC2RACE_TERRAN, "chillakilla" => Player::SC2RACE_RANDOM)),
                        )
                ),

                4 => array(
                        "war"	=> array(0, 5, 'dw.',		'DE', new \Datetime('2011-05-08 19:00:00')),
                        "games"	=> array(
                                array(0, 2, array("Hane" => Player::SC2RACE_PROTOSS),		array("Justify" => Player::SC2RACE_PROTOSS)),
                                array(1, 2, array("Sweety" => Player::SC2RACE_PROTOSS),		array("iRa" => Player::SC2RACE_PROTOSS)),
                                array(0, 2, array("-" => Player::SC2RACE_RANDOM),			array("Defwin" => Player::SC2RACE_RANDOM)),
                                array(0, 2, array("mYst" => Player::SC2RACE_RANDOM),		array("Drunken" => Player::SC2RACE_TERRAN)),
                                array(1, 2, array("Sweety" => Player::SC2RACE_PROTOSS, "Tartiflette" => Player::SC2RACE_TERRAN), array("FLamer" => Player::SC2RACE_ZERG, "Justify" => Player::SC2RACE_PROTOSS)),
                        )
                ),

                6 => array(
                        "war"	=> array(2, 3, 'hwbg',		'BG', new \Datetime('2011-05-22 19:00:00')),
                        "games"	=> array(
                                array(0, 2, array("Hane" => Player::SC2RACE_PROTOSS),		array("Jei" => Player::SC2RACE_PROTOSS)),
                                array(2, 0, array("GsHeeRo" => Player::SC2RACE_ZERG),		array("hwbgLan" => Player::SC2RACE_PROTOSS)),
                                array(1, 2, array("Tartiflette" => Player::SC2RACE_TERRAN),	array("hwbgGiantt" => Player::SC2RACE_ZERG)),
                                array(2, 0, array("Bouh" => Player::SC2RACE_PROTOSS),		array("MiSePie" => Player::SC2RACE_PROTOSS)),
                                array(1, 2, array("Milla" => Player::SC2RACE_PROTOSS, "IceDice" => Player::SC2RACE_TERRAN),	array("hwbgLan" => Player::SC2RACE_PROTOSS, "hwbgGiantt" => Player::SC2RACE_ZERG)),
                        )
                ),
        );
        $this->processLeagueWars('sc2cl_2', $wars);

        // Pandaria 2
        $wars = array(
                0 => array(
                        "war"	=> array(3, 2, 'PhX',		'FR', new \Datetime('2011-05-01 17:00:00')),
                        "games"	=> array(
                                array(2, 0, array("MttN" => Player::SC2RACE_TERRAN),		array("agmbibi" => Player::SC2RACE_PROTOSS)),
                                array(2, 0, array("GsHeeRo" => Player::SC2RACE_ZERG),		array("zenob" => Player::SC2RACE_PROTOSS)),
                                array(1, 2, array("Tartiflette" => Player::SC2RACE_TERRAN),	array("PhXǂLiZZaRoC" => Player::SC2RACE_PROTOSS)),
                                array(2, 0, array("Rasmuth" => Player::SC2RACE_PROTOSS),	array("oSkVal" => Player::SC2RACE_TERRAN)),
                                array(0, 2, array("GsHeeRo" => Player::SC2RACE_ZERG, "paupiette" => Player::SC2RACE_TERRAN), array("oSkVal" => Player::SC2RACE_TERRAN, "PhXliXOu" => Player::SC2RACE_PROTOSS)),
                        )
                ),

                1 => array(
                        "war"	=> array(3, 2, 'FOX',		'FR', new \Datetime('2011-05-08 17:00:00')),
                        "games"	=> array(
                                array(0, 2, array("Sweety" => Player::SC2RACE_TERRAN),		array("sMiLe" => Player::SC2RACE_ZERG)),
                                array(0, 2, array("MttN" => Player::SC2RACE_ZERG),			array("Foumiz" => Player::SC2RACE_PROTOSS)),
                                array(2, 1, array("Pepem" => Player::SC2RACE_TERRAN),		array("FOXTristaR" => Player::SC2RACE_TERRAN)),
                                array(2, 0, array("Rasmuth" => Player::SC2RACE_PROTOSS),	array("SaJa" => Player::SC2RACE_PROTOSS)),
                                array(2, 1, array("Sweety" => Player::SC2RACE_PROTOSS, "Tartiflette" => Player::SC2RACE_TERRAN), array("DaRa" => Player::SC2RACE_PROTOSS, "boyyy" => Player::SC2RACE_ZERG)),
                        )
                ),

                2 => array(
                        "war"	=> array(3, 2, 'nSg',		'FR', new \Datetime('2011-05-15 17:00:00')),
                        "games"	=> array(
                                array(1, 2, array("GsHeeRo" => Player::SC2RACE_ZERG),		array("NeOAnGeL" => Player::SC2RACE_PROTOSS)),
                                array(1, 2, array("Sweety" => Player::SC2RACE_PROTOSS),		array("Diegopyc" => Player::SC2RACE_ZERG)),
                                array(2, 1, array("Pepem" => Player::SC2RACE_ZERG),			array("Burimiche" => Player::SC2RACE_PROTOSS)),
                                array(2, 1, array("Rasmuth" => Player::SC2RACE_PROTOSS),	array("Rexar" => Player::SC2RACE_PROTOSS)),
                                array(2, 1, array("Sweety" => Player::SC2RACE_PROTOSS, "Tartiflette" => Player::SC2RACE_TERRAN), array("NeOAnGeL" => Player::SC2RACE_PROTOSS, "Thadortin" => Player::SC2RACE_ZERG)),
                        )
                ),

                3 => array(
                        "war"	=> array(2, 3, 'sAs',		'FR', new \Datetime('2011-05-22 17:00:00')),
                        "games"	=> array(
                                array(0, 2, array("Rasmuth" => Player::SC2RACE_PROTOSS),	array("WiCkeDTeRRaN" => Player::SC2RACE_TERRAN)),
                                array(2, 0, array("Pepem" => Player::SC2RACE_ZERG),			array("sAsPCK" => Player::SC2RACE_TERRAN)),
                                array(1, 2, array("Sweety" => Player::SC2RACE_PROTOSS),		array("sAsUrice" => Player::SC2RACE_PROTOSS)),
                                array(1, 2, array("Bouh" => Player::SC2RACE_PROTOSS),		array("sAsGanil" => Player::SC2RACE_TERRAN)),
                                array(2, 1, array("Sweety" => Player::SC2RACE_PROTOSS, "Tartiflette" => Player::SC2RACE_TERRAN), array("Olinous" => Player::SC2RACE_TERRAN, "TaMoCk" => Player::SC2RACE_ZERG)),
                        )
                ),
        );

        $this->processLeagueWars('pandaria_2', $wars);
    }

    public function processLeagueWars($seasonName, array $wars)
    {
        $data = array();
        foreach($wars as $war)
        {
            $date = $war['war'][4];

            $o = new War();
            $o->setTeam($this->objects['team']['nB.SC2']);
            $o->setTeamScore($war['war'][0]);
            $o->setOpponentScore($war['war'][1]);
            $o->setOpponentName($war['war'][2]);
            $o->setOpponentCountry($war['war'][3]);
            $o->setDate($date);
            $o->setSeason($this->objects['seasons'][$seasonName]);

            foreach($war['games'] as $game)
            {
                $wg = new WarGame();
                $wg->setTeam1Score($game[0]);
                $wg->setTeam2Score($game[1]);
                $wg->setWar($o);

                $g = new Game();
                $g->setDate($date);

                foreach($game[2] as $name => $race)
                {
                    $gp = new GamePlayer();
                    if(isset($this->objects['player'][$name]))
                    {
                        $gp->setPlayer($this->objects['player'][$name]);
                    }
                    $gp->setName($name);
                    $gp->setRace($race);
                    $gp->setTeam(1);
                    $gp->setWarGame($wg);
                    $gp->setGame($g);
                    $g->addPlayer($gp);
                }

                foreach($game[3] as $name => $race)
                {
                    $gp = new GamePlayer();
                    if(isset($this->objects['player'][$name]))
                    {
                        $gp->setPlayer($this->objects['player'][$name]);
                    }
                    $gp->setName($name);
                    $gp->setRace($race);
                    $gp->setTeam(2);
                    $gp->setWarGame($wg);
                    $gp->setGame($g);
                    $g->addPlayer($gp);
                }

                if($game[0] > 0)
                {
                    foreach(range(1, $game[0]) as $i)
                    {
                        $clone = clone $g;
                        $clone->setWarGame($wg);
                        $clone->setWar($o);
                        $clone->setWinner(1);
                        $wg->addGame($clone);
                    }
                }

                if($game[1] > 0)
                {
                    foreach(range(1, $game[1]) as $i)
                    {
                        $clone = clone $g;
                        $clone->setWarGame($wg);
                        $clone->setWar($o);
                        $clone->setWinner(2);
                        $wg->addGame($clone);
                    }
                }

                $o->addGame($wg);
            }

            $data[] = $o;
        }

        $this->registerObjects($seasonName.'_wars', $data);
    }
}