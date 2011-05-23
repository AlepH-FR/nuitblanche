<?php

namespace IHQS\NuitBlancheBundle\Entity;

use IHQS\NuitBlancheBundle\Model\PlayerRepository;

/**
 * @orm:Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\GamePlayerRepository")
 * @orm:Table(name="gameplayer")
 * @orm:HasLifecycleCallbacks
 */
class GamePlayer
{
    /**
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @orm:ManyToOne(targetEntity="Game", cascade={"all"})
     */
    protected $game;

    /**
     * @orm:ManyToOne(targetEntity="WarGame")
     */
    protected $warGame;

    /**
     * @orm:ManyToOne(targetEntity="Player")
     */
    protected $player;

    /**
     * @orm:Column(type="string", nullable="true")
     */
    protected $name;

    /**
     * @orm:Column(type="string")
     */
    protected $race;

    /**
     * @orm:Column(type="string", nullable="true")
     */
    protected $color;

    /**
     * @orm:Column(type="integer", nullable="true")
     */
    protected $apm;

    /**
     * @orm:Column(type="integer")
     */
    protected $team;

	protected $playerRepo;

    public function getId() {
        return $this->id;
    }

    public function getGame() {
        return $this->game;
    }

    public function setGame(Game $game) {
        $this->game = $game;
    }

    public function getPlayer() {
        return $this->player;
    }

    public function setPlayer(Player $player) {
        $this->player = $player;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getRace() {
        return $this->race;
    }

    public function setRace($race) {
        if(!in_array($race, Player::$_sc2races))
        {
            throw new \InvalidArgumentException('Invalid race "' . $race . '" for StarCraft 2 Race');
        }
        $this->race = $race;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function getApm() {
        return $this->apm;
    }

    public function setApm($apm) {
        $this->apm = $apm;
    }

    public function getTeam() {
        return $this->team;
    }

    public function setTeam($team) {
        $this->team = $team;
    }

    public function getWarGame()
    {
        return $this->warGame;
    }

    public function setWarGame(WarGame $warGame)
    {
        $this->warGame = $warGame;
    }

	public function setPlayerRepository(PlayerRepository $playerRepo)
	{
		$this->playerRepo = $playerRepo;
	}
	
	/**
	 * @orm:PrePersist
	 */
	public function prePersist()
	{
		if(is_null($this->playerRepo))
		{
			return;
		}
		
		$player = $this->playerRepo->findOneBySc2Account($this->getName());
		if($player instanceof Player)
		{
			$this->player = $player;
		}
	}

    public function __toString()
    {
        return $this->getName();
    }
}