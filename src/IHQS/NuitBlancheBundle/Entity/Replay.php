<?php

namespace IHQS\NuitBlancheBundle\Entity;

/**
 * @orm:Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\ReplayRepository")
 */
class Replay
{
    /**
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @orm:Column(type="string")
     */
    protected $file;

    /**
     * @orm:Column(type="string")
     */
    protected $chart;

    /**
     * @orm:OneToOne(targetEntity="game")
     */
    protected $game;

    /**
     * @orm:Column(type="integer")
     */
    protected $size;
    
    /**
     * @orm:Column(type="string")
     */
    protected $length;
    
    /**
     * @orm:Column(type="string")
     */
    protected $obs;

    /**
     * @orm:Column(type="string")
     */
    protected $realm;

    /**
     * @orm:Column(type="string")
     */
    protected $version;

    public function getId() {
        return $this->id;
    }

    public function getFile() {
        return $this->file;
    }

    public function setFile($file) {
        $this->file = $file;
    }

    public function getChart() {
        return $this->chart;
    }

    public function setChart($chart) {
        $this->chart = $chart;
    }

    public function getGame() {
        return $this->game;
    }

    public function setGame(Game $game) {
        $this->game = $game;
    }

    public function getSize() {
        return $this->size;
    }

    public function setSize($size) {
        $this->size = $size;
    }

    public function getLength() {
        return $this->length;
    }

    public function setLength($length) {
        $this->length = $length;
    }

    public function getObs() {
        return $this->obs;
    }

    public function setObs($obs) {
        $this->obs = $obs;
    }

    public function getRealm() {
        return $this->realm;
    }

    public function setRealm($realm) {
        $this->realm = $realm;
    }

    public function getVersion() {
        return $this->version;
    }

    public function setVersion($version) {
        $this->version = $version;
    }
}
