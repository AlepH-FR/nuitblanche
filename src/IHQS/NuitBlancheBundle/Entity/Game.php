<?php

namespace IHQS\NuitBlancheBundle\Entity;

/**
 * @orm:Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\GameRepository")
 */
class Game
{
    const RESULT_WIN    = "win";
    const RESULT_LOSS   = "loss";

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
}
