<?php

namespace IHQS\NuitBlancheBundle\Entity;

/**
 * @orm:Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\PlayerRepository")
 */
class Player
{
    const SC2RACE_PROTOSS = "protoss";
    const SC2RACE_TERRAN  = "terran";
    const SC2RACE_ZERG    = "zerg";

    static public $_sc2races = array(
        self::SC2RACE_PROTOSS,
        self::SC2RACE_TERRAN,
        self::SC2RACE_ZERG
    );

    /**
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @orm:ManyToOne(targetEntity="User")
     * @orm:JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @orm:Column(type="string")
     */
    protected $sc2Role;

    /**
     * @orm:Column(type="integer")
     */
    protected $sc2Id;

    /**
     * @orm:Column(type="string")
     */
    protected $sc2Race;

    /**
     * @orm:Column(type="string")
     */
    protected $sc2ProfileEsl;

    /**
     * @orm:Column(type="string")
     */
    protected $sc2ProfileSc2cl;
    
    /**
     * @orm:Column(type="string")
     */
    protected $sc2ProfilePandaria;

    /**
     * @orm:ManyToMany(targetEntity="Team", mappedBy="players")
     */
    protected $teams;

    /**
     * @orm:OneToMany(targetEntity="GamePlayer", mappedBy="player")
     */
    protected $games;

    protected $stats;

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

    public function getSc2Race() {
        return $this->sc2Race;
    }

    public function setSc2Race($sc2Race) {
        if(!in_array($sc2Race, Player::$_sc2races))
        {
            throw new \InvalidArgumentException('Invalid parameter for StarCraft 2 Race');
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
        foreach($this->getGames() as $game)
        {
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
            "_1v1protoss"   => array(),
            "_1v1terran"    => array(),
            "_1v1zerg"      => array()
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

    public function get2v2Teams() {
        
    }
}