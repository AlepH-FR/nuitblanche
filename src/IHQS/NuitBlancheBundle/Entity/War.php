<?php

namespace IHQS\NuitBlancheBundle\Entity;

/**
 * @orm:Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\WarRepository")
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
     * @orm:Column(type="string")
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
     * @orm:OneToMany(targetEntity="Game", mappedBy="war")
     */
    protected $games;

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
}
