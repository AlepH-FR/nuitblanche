<?php

namespace IHQS\NuitBlancheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\PlayerRepository")
 * @ORM\Table(name="player")
 */
class Player
{
    const SC2RACE_PROTOSS = "protoss";
    const SC2RACE_TERRAN  = "terran";
    const SC2RACE_ZERG    = "zerg";
    const SC2RACE_RANDOM  = "random";

    static public $_sc2races = array(
        self::SC2RACE_PROTOSS	=> self::SC2RACE_PROTOSS,
        self::SC2RACE_TERRAN	=> self::SC2RACE_TERRAN,
        self::SC2RACE_ZERG		=> self::SC2RACE_ZERG,
        self::SC2RACE_RANDOM	=> self::SC2RACE_RANDOM
    );

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="player", cascade={"persist"})
     * @Assert\Valid()
     */
    protected $user;

    /**
     * @ORM\Column(type="string", nullable="true")
     */
    protected $sc2Role;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(groups="Registration", message = "Please add your SC2 account id")
     * @Assert\Regex("/\d+/")
     */
    protected $sc2Id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(groups="Registration", message = "Please add your SC2 account")
     */
    protected $sc2Account;

    /**
     * @ORM\Column(type="string")
     * @Assert\Choice(callback = "getRaces")
     */
    protected $sc2Race;

    /**
     * @ORM\Column(type="string", nullable="true")
     * @Assert\Regex("/\d+/")
     */
    protected $sc2ProfileEsl;

    /**
     * @ORM\Column(type="string", nullable="true")
     * @Assert\Regex("/\d+/")
     */
    protected $sc2ProfileSc2cl;
    
    /**
     * @ORM\Column(type="string", nullable="true")
     */
    protected $sc2ProfilePandaria;

    /**
     * @ORM\ManyToMany(targetEntity="Team", mappedBy="players")
     */
    protected $teams;

    /**
     * @ORM\OneToMany(targetEntity="GamePlayer", mappedBy="player")
     * @ORM\OrderBy({"id" = "DESC"})
     */
    protected $games;

    protected $stats;

    protected $ranks;

    protected $statsInit = false;
    
    public function getId() {
        return $this->id;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser(User $user) {
        $this->user = $user;
    }

    public function getUsername() {
        return $this->user->getUserName();
    }

    public function getSc2Role() {
        return $this->sc2Role;
    }

    public function setSc2Role($sc2Role) {
        $this->sc2Role = $sc2Role;
    }

    public function getSc2Id() {
        return $this->sc2Id;
    } 

    public function setSc2Id($sc2Id) {
        $this->sc2Id = $sc2Id;
    }

    public function getSc2Account() {
        return $this->sc2Account;
    }

    public function setSc2Account($sc2Account) {
        $this->sc2Account = $sc2Account;
    }

    public function getSc2Race() {
        return $this->sc2Race;
    }

    public function setSc2Race($sc2Race) {
        if(!in_array($sc2Race, Player::$_sc2races))
        {
            throw new \InvalidArgumentException('Invalid parameter "' . $sc2Race . '" for StarCraft 2 Race');
        }
        $this->sc2Race = $sc2Race;
    }

    public function getSc2ProfileEsl() {
        return $this->sc2ProfileEsl;
    }

    public function setSc2ProfileEsl($sc2ProfileEsl) {
        $this->sc2ProfileEsl = $sc2ProfileEsl;
    }

    public function getSc2ProfileSc2cl() {
        return $this->sc2ProfileSc2cl;
    }

    public function setSc2ProfileSc2cl($sc2ProfileSc2cl) {
        $this->sc2ProfileSc2cl = $sc2ProfileSc2cl;
    }

    public function getSc2ProfilePandaria() {
        return $this->sc2ProfilePandaria;
    }

    public function setSc2ProfilePandaria($sc2ProfilePandaria) {
        $this->sc2ProfilePandaria = $sc2ProfilePandaria;
    }

    public function getGames() {
        $games = $this->games;

        $result = array();
        foreach($games as $game)
        {
            $result[] = $game->getGame();
        }
        return $result;
    }

    public function getWarGames()
    {
        $warGames = array();
        foreach($this->getGames() as $game)
        {
            $wg = $game->getWarGame();
            if($wg instanceof WarGame)
            {
                $warGames[$wg->getId()] = $wg;
            }
        }

        return $warGames;
    }

    public function getReplays() {
        $games = $this->games;

        $result = array();
        foreach($games as $game)
        {
            if(!$game->getGame())               { continue; }
            if(!$game->getGame()->getReplay())  { continue; }
            
            $result[] = $game->getGame();
        }
        
        return $result;
    }

    public function getStats()
    {
        if($this->statsInit) { return $this->stats; }

        $this->initStatsVariables();

        $counter = 0;
        foreach($this->getWarGames() as $game)
        {
			$team2 = false;
			foreach($game->getTeam2() as $p2)
			{
				if($p2->getPlayer() && $p2->getPlayer()->getId() == $this->getId()) { $team2 = true; break; }
			}
			if($team2) { continue; }


            $type = "_" . $game->getType();
            
            if($game->getTeam1Result() == Game::RESULT_WIN)     { $this->stats[$type]["wins"]++; }
            if($game->getTeam1Result() == Game::RESULT_LOSS)    { $this->stats[$type]["losses"]++; }

            if($game->getType() == Game::TYPE_1v1)
            {
                $type = $type.$game->getTeam2Race();
                if($game->getTeam1Result() == Game::RESULT_WIN)     { $this->stats[$type]["wins"]++; }
                if($game->getTeam1Result() == Game::RESULT_LOSS)    { $this->stats[$type]["losses"]++; }
            }
        }

        foreach($this->stats as $type => $data)
        {
            $this->stats[$type]["ratio"] = (($data["losses"] + $data["wins"]) == 0)
                    ? 0
                    : round(100 * $data["wins"] / ($data["losses"] + $data["wins"]));
        }

        $this->statsInit = true;
        return $this->stats;
    }

    public function initStatsVariables()
    {
        $this->stats = array(
            "_1v1" => array(),
            "_2v2" => array(),
            "_3v3" => array(),
            "_4v4" => array(),
            "_1v1protoss"   => array(),
            "_1v1terran"    => array(),
            "_1v1zerg"      => array(),
            "_1v1random"    => array()
        );

        foreach($this->stats as $type => $data)
        {
            $this->stats[$type] = array(
                "wins"      => 0,
                "losses"    => 0,
                "ratio"     => 0
            );
        }
    }

    public function get2v2Teams()
    {
		$teams = array();
		
        foreach($this->getWarGames() as $game)
        {
            if($game->getType() != Game::TYPE_2v2)
            {
				continue; 
			}
			
			$team2 = false;
			foreach($game->getTeam2() as $p2)
			{
				if($p2->getPlayer() && $p2->getPlayer()->getId() == $this->getId()) { $team2 = true; break; }
			}
			if($team2) { continue; }

			// looking for ally
			$ally = null;
			$members = $game->getTeam1();
			foreach($members as $member)
			{
				if($member->getName() != $this->getSc2Account())
				{
					$ally = $member;
					break;
				}
			}

			// updating hash table
			$key = $ally->getName(). '_' . $ally->getRace();
			if(!isset($teams[$key]))
			{
				$teams[$key] = array(
					"allyName"	=> $ally->getName(),
					"allyRace"	=> $ally->getRace(),
					"wins"		=> 0,
					"losses"	=> 0
				);
			}

			if($game->getTeam1Result() == Game::RESULT_WIN)     { $teams[$key]["wins"]++; }
			if($game->getTeam1Result() == Game::RESULT_LOSS)    { $teams[$key]["losses"]++; }
		}

        foreach($teams as $key => $team)
        {
            $teams[$key]["ratio"] = (($team["losses"] + $team["wins"]) == 0)
                    ? 0
                    : round(100 * $team["wins"] / ($team["losses"] + $team["wins"]));
        }

		usort($teams, function($a, $b) {
			if($a['wins'] == $b['wins'])
			{
				if($a['losses'] == $b['losses']) { return 0; }
				return $a['losses'] > $b['losses'] ? 1 : -1;
			}

			return $a['wins'] < $b['wins'] ? 1 : -1;
		});
		return $teams;
    }

	public function getSc2Ranks()
	{
		if(!isset($this->sc2ranks))
		{
			$ranks = new \SC2Ranks\SC2Ranks('clan-nuitblanche.org');
			$api = $ranks->getApi('player')->setAccount($this->sc2Account, $this->sc2Id);

			$sc2ranks = array();
			$sc2ranks['base']	= $api->baseChar();
			$sc2ranks['_1v1']	= $api->charTeams(1);
			$sc2ranks['_2v2']	= $api->charTeams(2);

			foreach($sc2ranks as $type => $data)
			{
				if(!isset($data->teams)) { continue; }

				foreach($data->teams as $key => $team)
				{
					$level = 1;
					if($team->division_rank < 50) { $level = 2; }
					if($team->division_rank < 16) { $level = 3; }
					if($team->division_rank < 8)  { $level = 4; }
					$sc2ranks[$type]->teams[$key]->leaguePic = 'bundles/ihqsnuitblanche/images/sc2ranks/' . $team->league . '-' . $level . '.png';

					$sc2ranks[$type]->teams[$key]->ratio = '-';
					if($team->wins + $team->losses > 0)
					{
						$sc2ranks[$type]->teams[$key]->ratio = floor(100 * $team->wins / ($team->wins + $team->losses));
					}
				}

				usort($data->teams, function($a, $b) {
					if($a->wins == $b->wins)
					{
						if($a->losses == $b->losses) { return 0; }
						return $a->losses > $b->losses ? 1 : -1;
					}

					return $a->wins < $b->wins ? 1 : -1;
				});
			}

			$this->ranks = $sc2ranks;
		}

		return $this->ranks;
	}

	public function __toString() {
		return $this->getSc2Account();
	}
}