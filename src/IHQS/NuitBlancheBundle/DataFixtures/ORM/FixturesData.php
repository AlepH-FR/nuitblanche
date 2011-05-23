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
		$user->setPassword('leeloo07');
		$user->setFirstName('Antoine');
		$user->setLastName('Berranger');
		$user->setCity('Nantes');
		$user->setCountry('France');
		$user->setTwitter('AlepH-FR');
		$user->setSkype('aleph_44');
		$user->setEmail('lysimaque@gmail.com');

		$o = new Player();
		$o->setUser($user);
		$o->setSc2Role('Admin');
		$o->setSc2Account('AlepH');
		$o->setSc2Id('372');
		$o->setSc2Race(Player::SC2RACE_PROTOSS);
		$o->setSc2ProfileEsl('5335303');
		$o->setSc2ProfileSc2cl('513123');
		$o->setSc2ProfilePandaria('AlepH_FR');
		$o->
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

        $this->registerObjects('player', $data);
	}

    public function createTeams()
    {
        $data = array();

		$o = new Team();
		$o->setIcon('nB)');
		$o->setName('nB.SC2');
		$o->setTag('/bundles/ihqsnuitblanche/images/ico/nb_boy.png');
		$o->addPlayer($this->objects['player']['AlepH']);
		$o->addPlayer($this->objects['player']['Fzero']);
        $data['nB.SC2'] = $o;

		$o = new Team();
		$o->setIcon('nB)');
		$o->setName('nB.SC2 Ladies');
		$o->setTag('/bundles/ihqsnuitblanche/images/ico/nb_girl.png');
        $data['nB.SC2 Ladies'] = $o;

		$o = new Team();
		$o->setIcon('nB)');
		$o->setName('nB.SC2 Oldies');
		$o->setTag('/bundles/ihqsnuitblanche/images/ico/nb_boy.png');
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
				<li>detail clan war page with related replays</li>
				<li>detail profiles with statistics, clan war games and replays related</li>
				<li>cute replay page with apm chart, chat log and more</li>
				<li>... and more you'll discover while browsing this website</li>
			</ul>
			<p>
				But we are still in a <strong>v0.9 beta version</strong> !<br />
				Until the end of the summer, I'll add more cool stuff :
			</p>
			<ul>
				<li>forum</li>
				<li>profile edition</li>
				<li>embedded stream pages, with live stream, show history, ...</li>
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
		$o->setStartDate('2010-09-01 00:00:00');
		$o->setEnded(false);
		$seasons['friendly_0'] = $o;

		$o = new Season();
		$o->setDivision(3);
		$o->setLeague($leagues['pandaria']);
		$o->setNumber(1);
		$o->setPosition(1);
		$o->setStartDate('2010-09-19 00:00:00');
		$o->setEndDate('2010-12-15 00:00:00');
		$o->setEnded(true);
		$seasons['pandaria_1'] = $o;

		$o = new Season();
		$o->setDivision('5e');
		$o->setLeague($leagues['sc2cl']);
		$o->setNumber(1);
		$o->setPosition(2);
		$o->setStartDate('2010-09-26 00:00:00');
		$o->setEndDate('2010-11-31 00:00:00');
		$o->setEnded(true);
		$seasons['sc2cl_1'] = $o;

		$o = new Season();
		$o->setDivision('1');
		$o->setLeague($leagues['sc2f']);
		$o->setNumber(1);
		$o->setPosition(3);
		$o->setStartDate('2010-11-28 00:00:00');
		$o->setEndDate('2011-01-23 00:00:00');
		$o->setEnded(true);
		$seasons['sc2f_1'] = $o;

		$o = new Season();
		$o->setDivision('3b');
		$o->setLeague($leagues['sc2cl']);
		$o->setNumber(2);
		$o->setStartDate('2011-04-10 00:00:00');
		$o->setEndDate('2011-06-27 00:00:00');
		$o->setEnded(false);
		$seasons['sc2cl_2'] = $o;

		$o = new Season();
		$o->setDivision(3);
		$o->setLeague($leagues['pandaria']);
		$o->setNumber(2);
		$o->setStartDate('2011-04-24 00:00:00');
		$o->setEndDate('2011-07-03 00:00:00');
		$o->setEnded(false);
		$seasons['pandaria_2'] = $o;

        $this->registerObjects('leagues', $leagues);
        $this->registerObjects('seasons', $seasons);
	}

	public function createWars()
	{
		
	}
}