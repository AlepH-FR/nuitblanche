<?php

namespace IHQS\NuitBlancheBundle\Entity;

/**
 * @orm:Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\SeasonRepository")
 * @orm:Table(name="season")
 */
class Season
{
    /**
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @orm:ManyToOne(targetEntity="League")
     */
    protected $league;

    /**
     * @orm:Column(type="integer")
     */
    protected $number;

    /**
     * @orm:Column(type="integer")
     */
    protected $division;

    /**
     * @orm:Column(type="datetime")
     */
    protected $startDate;

    /**
     * @orm:Column(type="datetime")
     */
    protected $endDate;

    /**
     * @orm:Column(type="boolean")
     */
    protected $ended;

    /**
     * @orm:Column(type="integer")
     */
    protected $wins;

    /**
     * @orm:Column(type="integer")
     */
    protected $draws;

    /**
     * @orm:Column(type="integer")
     */
    protected $losses;

    /**
     * @orm:Column(type="integer")
     */
    protected $position;

    /**
     * @orm:OneToMany(targetEntity="War", mappedBy="season")
     */
    protected $wars;

    public function getId() {
        return $this->id;
    }

    public function getLeague() {
        return $this->league;
    }

    public function setLeague(League $league) {
        $this->league = $league;
    }

    public function getNumber() {
        return $this->number;
    }

    public function setNumber($number) {
        $this->number = $number;
    }

    public function getDivision() {
        return $this->division;
    }

    public function setDivision($division) {
        $this->division = $division;
    }

    public function getStartDate() {
        return $this->startDate;
    }

    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }

    public function getEndDate() {
        return $this->endDate;
    }

    public function setEndDate($endDate) {
        $this->endDate = $endDate;
    }

    public function getEnded() {
        return $this->ended;
    }

    public function setEnded($ended) {
        $this->ended = $ended;
    }

    public function getWins() {
        return $this->wins;
    }

    public function setWins($wins) {
        $this->wins = $wins;
    }

    public function getDraws() {
        return $this->draws;
    }

    public function setDraws($draws) {
        $this->draws = $draws;
    }

    public function getLosses() {
        return $this->losses;
    }

    public function setLosses($losses) {
        $this->losses = $losses;
    }

    public function getPosition() {
        return $this->position;
    }

    public function setPosition($position) {
        $this->position = $position;
    }

    public function getWars() {
        return $this->wars;
    }

    public function getNextWar()
    {
        return current($this->wars);
    }
}
