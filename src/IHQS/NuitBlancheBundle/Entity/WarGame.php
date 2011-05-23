<?php

namespace IHQS\NuitBlancheBundle\Entity;
use IHQS\NuitBlancheBundle\Entity\Base\Game as BaseGame;
use Doctrine\Common\NotifyPropertyChanged;
use Doctrine\Common\PropertyChangedListener;
/**
 * @orm:Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\WarGameRepository")
 * @orm:Table(name="wargame")
 * @orm:HasLifecycleCallbacks
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
     * @orm:OneToMany(targetEntity="GamePlayer", mappedBy="warGame", cascade={"persist"})
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
     * @orm:OneToMany(targetEntity="Game", mappedBy="warGame", cascade={"all"})
     */
    protected $games;

    private $_listeners = array();

	public function __construct()
	{
		$this->games	= new \Doctrine\Common\Collections\ArrayCollection();
		$this->players	= new \Doctrine\Common\Collections\ArrayCollection();
	}

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

	public function addGame(Game $game)
	{
		$this->games->add($game);
	}

	public function removeGame(Game $game)
	{
		$this->games->remove($game);
	}

	public function setGames(\Doctrine\Common\Collections\ArrayCollection $games)
	{
		$this->games = $games;
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

	/**
	 * @orm:PrePersist
	 */
	public function prePersist()
	{
		$this->updateTeamScores();
	}

	/**
	 * @orm:PreUpdate
	 */
	public function preUpdate()
	{
		$this->updateTeamScores();
	}

	public function updateTeamScores()
	{
		$team1score = 0;
		$team2score = 0;

		foreach($this->games as $game)
		{
			$var = "team" . $game->getWinner() . "score";
			${$var}++;
		}

		$this->setTeam1Score($team1score);
		$this->setTeam2Score($team2score);
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