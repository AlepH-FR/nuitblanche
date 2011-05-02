<?php

namespace IHQS\NuitBlancheBundle\Entity;

/**
 * @orm:Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\TeamRepository")
 */
class Team
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
    protected $name;

    /**
     * @orm:Column(type="string")
     */
    protected $icon;

    /**
     * @orm:Column(type="string")
     */
    protected $tag;

    /**
     * @orm:ManyToMany(targetEntity="Player", inversedBy="teams")
     * @orm:JoinTable()
     */
    protected $players;

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getIcon() {
        return $this->icon;
    }

    public function setIcon($icon) {
        $this->icon = $icon;
    }

    public function getTag() {
        return $this->tag;
    }

    public function setTag($tag) {
        $this->tag = $tag;
    }

    public function getPlayers() {
        return $this->players;
    }

    public function addPlayer(Player $player)
    {
        $this->players->add($player);
    }

    public function removePlayer(Player $player)
    {
        $this->players->remove($player);
    }
}