<?php

namespace IHQS\NuitBlancheBundle\Entity;

/**
 * @orm:Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\WarRepository")
 * @orm:Table(name="war")
 * @orm:HasLifecycleCallbacks
 */
class War
{
    /**
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @orm:Column(type="datetime")
     */
    protected $date;

    /**
     * @orm:Column(type="string", nullable="true")
     */
    protected $maps;

    /**
     * @orm:ManyToOne(targetEntity="Team")
     */
    protected $team;

    /**
     * @orm:ManyToOne(targetEntity="Season")
     */
    protected $season;

    /**
     * @orm:Column(type="integer")
     */
    protected $teamScore;

    /**
     * @orm:Column(type="string")
     */
    protected $opponentName;

    /**
     * @orm:Column(type="integer")
     */
    protected $opponentScore;

    /**
     * @orm:Column(type="string")
     */
    protected $opponentCountry;

    /**
     * @orm:Column(type="string")
     */
    protected $result;

    /**
     * @orm:OneToMany(targetEntity="WarGame", mappedBy="war", cascade={"persist", "update", "delete"})
     */
    protected $games;

	public function __construct()
	{
		$this->games = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * @orm:PrePersist
	 */
	public function prePersist()
	{
		if($this->teamScore > $this->opponentScore)		{ $this->setResult(WarGame::RESULT_WIN); }
		if($this->teamScore < $this->opponentScore)		{ $this->setResult(WarGame::RESULT_LOSS); }
		if($this->teamScore == $this->opponentScore)	{ $this->setResult(WarGame::RESULT_DRAW); }

		foreach($this->games as $warGame)
		{
			foreach($warGame->getGames() as $game)
			{
				$game->setDate($this->getDate());
			}
		}
	}

    public function getId() {
        return $this->id;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getMaps() {
        return $this->maps;
    }

    public function setMaps($maps) {
        $this->maps = $maps;
    }

    public function getTeam() {
        return $this->team;
    }

    public function setTeam(Team $team) {
        $this->team = $team;
    }

    public function getSeason() {
        return $this->season;
    }

    public function setSeason(Season $season) {
        $this->season = $season;
    }

    public function getTeamScore() {
        return $this->teamScore;
    }

    public function setTeamScore($teamScore) {
        $this->teamScore = $teamScore;
    }

    public function getOpponentName() {
        return $this->opponentName;
    }

    public function setOpponentName($opponentName) {
        $this->opponentName = $opponentName;
    }

    public function getOpponentScore() {
        return $this->opponentScore;
    }

    public function setOpponentScore($opponentScore) {
        $this->opponentScore = $opponentScore;
    }

    public function getOpponentCountry() {
        return $this->opponentCountry;
    }

    public function setOpponentCountry($opponentCountry) {
        $this->opponentCountry = $opponentCountry;
    }

    public function getResult() {
        return $this->result;
    }

    public function setResult($result) {
        if(!in_array($result, WarGame::$_results))
        {
            throw new \InvalidArgumentException('Invalid parameter for team result');
        }
        $this->result = $result;
    }

    public function getGames() {
        return $this->games;
    }

	public function setGames(\Doctrine\Common\Collections\ArrayCollection $games)
	{
		$this->games = $games;
	}

	public function getReplays()
	{
		$replays = array();
		foreach($this->getGames() as $wg)
		{
			foreach($wg->getGames() as $game)
			{
				$replay = $game->getReplay();
				if($replay instanceof Replay)
				{
					array_push($replays, $game);
				}
			}
		}

		return $replays;
	}

	protected function setNumberOfGames($number, $type)
	{
		foreach(range(1, $number) as $i)
		{
			$warGame = new WarGame();
			$warGame->setWar($this);
			$warGame->setTeam1Score(0);
			$warGame->setTeam2Score(0);

			$game = new Game();
			$game->setWarGame($warGame);
			$game->setDate($this->getDate());

			foreach(range(1, 3) as $i)
			{
				$clone = clone $game;
				foreach(range(1, $type*2) as $i)
				{
					$gamePlayer = new GamePlayer();
					$gamePlayer->setGame($clone);
					$gamePlayer->setWarGame($warGame);
					$gamePlayer->setRace(Player::SC2RACE_RANDOM);
					$gamePlayer->setTeam(round($i / $type));
					$clone->addPlayer($gamePlayer);
				}

				$warGame->addGame($clone);
			}

			$this->games->add($warGame);
		}
	}

	public function getNumberOf1on1Games()
	{
		$count = 0;
		foreach($this->games as $game)
		{
			if($game->getType() == Game::TYPE_1v1)
			{
				$count++;
			}
		}

		return $count;
	}

	public function setNumberOf1on1Games($number)
	{
		return $this->setNumberOfGames($number, 1);
	}

	public function getNumberOf2on2Games()
	{
		$count = 0;
		foreach($this->games as $game)
		{
			if($game->getType() == Game::TYPE_2v2)
			{
				$count++;
			}
		}

		return $count;
	}

	public function setNumberOf2on2Games($number)
	{
		return $this->setNumberOfGames($number, 2);
	}
}
