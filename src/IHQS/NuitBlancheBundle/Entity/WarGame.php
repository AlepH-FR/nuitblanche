<?php

namespace IHQS\NuitBlancheBundle\Entity;
use IHQS\NuitBlancheBundle\Entity\Base\Game as BaseGame;

/**
 * @orm:Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\WarGameRepository")
 * @orm:Table(name="wargame")
 */
class WarGame extends BaseGame
{
    /**
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @orm:ManyToOne(targetEntity="War")
     */
    protected $war;

    /**
     * @orm:OneToMany(targetEntity="GamePlayer", mappedBy="warGame")
     */
    protected $players;

    /**
     * @orm:Column(type="integer")
     */
    protected $team1Score;

    /**
     * @orm:Column(type="integer")
     */
    protected $team2Score;

    /**
     * @orm:OneToMany(targetEntity="Game", mappedBy="warGame")
     */
    protected $games;

	public function getId()
	{
		return $this->id;
	}

	public function getWar()
	{
		return $this->war;
	}

	public function setWar(War $war)
	{
		$this->war = $war;
	}

	public function getGames()
	{
		return $this->games;
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

    public function getType()
    {
		return $this->games[0]->getType();
    }

	public function getTeam1Score()
	{
		return $this->team1Score;
	}

	public function setTeam1Score($team1Score)
	{
		$this->team1Score = $team1Score;
	}

	public function getTeam2Score()
	{
		return $this->team2Score;
	}

	public function setTeam2Score($team2Score)
	{
		$this->team2Score = $team2Score;
	}

	public function __toString()
	{
		$infos = array(
			'vs',
			$this->getWar()->getOpponentName(),
			'-',
		);
		
		foreach($this->players as $player)
		{
			$infos[] = (string) $player;
		}

		return implode(' ', $infos);

	}
}