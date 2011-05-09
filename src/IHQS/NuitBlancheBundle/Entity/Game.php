<?php

namespace IHQS\NuitBlancheBundle\Entity;
use IHQS\NuitBlancheBundle\Entity\Base\Game as BaseGame;

/**
 * @orm:Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\GameRepository")
 * @orm:Table(name="game")
 */
class Game extends BaseGame
{
    const TYPE_1v1 = "1v1";
    const TYPE_2v2 = "2v2";
    const TYPE_3v4 = "3v3";
    const TYPE_4v4 = "4v4";

    static public $_results = array(
        self::RESULT_WIN,
        self::RESULT_LOSS
    );

    /**
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @orm:Column(type="datetime")
     */
    protected $date;

    /**
     * @orm:OneToMany(targetEntity="GamePlayer", mappedBy="game")
     */
    protected $players;

    /**
     * @orm:Column(type="integer")
     */
    protected $winner;

    /**
     * @orm:Column(type="string")
     */
    protected $map;
    
    /**
     * @orm:ManyToOne(targetEntity="WarGame")
	 * @orm:JoinColumn(name="warGame_id", nullable="true")
     */
    protected $warGame;

    /**
     * @orm:OneToOne(targetEntity="Replay", mappedBy="game")
     */
    protected $replay;

    public function getId() {
        return $this->id;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getWar() {
        return $this->war;
    }

    public function setWar(War $war) {
        $this->war = $war;
    }

    public function getPlayers() {
        return $this->players;
    }

    public function setPlayers($players) {
        $this->players = $players;
    }

	public function addPlayer(Player $player) {
		$this->players->add($player);
	}

	public function removePlayer(Player $player) {
		$this->players->remove($player);
	}

    public function getWinner() {
        return $this->winner;
    }

    public function setWinner($winner) {
        $this->winner = $winner;
    }

    public function getMap() {
        return $this->map;
    }

    public function setMap($map) {
        $this->map = $map;
    }

    public function getReplay() {
        return $this->replay;
    }

    public function setReplay(Replay $replay) {
        $this->replay = $replay;
    }

	public function getWarGame()
	{
		return $this->warGame;
	}

	public function setWarGame(WarGame $warGame)
	{
		$this->warGame = $warGame;
		$this->setWar($warGame->getWar());
	}


	public function getType()
	{
        switch(count($this->players))
        {
            case 2: return Game::TYPE_1v1;
            case 4: return Game::TYPE_2v2;
            case 6: return Game::TYPE_3v3;
            case 8: return Game::TYPE_4v4;
        }

        throw new \RuntimeException('Invalid number of players for a game : ' . count($this->players));
	}

    public function getTeam1Score()
    {
        return ($this->winner == 1) ? 1: 0;
    }

    public function getTeam2Score()
    {
        return ($this->winner == 2) ? 1 : 0;
    }
}
