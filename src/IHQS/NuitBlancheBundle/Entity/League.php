<?php

namespace IHQS\NuitBlancheBundle\Entity;

/**
 * @orm:Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\LeagueRepository")
 */
class League
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
    protected $country;

    /**
     * @orm:OneToMany(targetEntity="Season", mappedBy="league")
     */
    protected $seasons;

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function getSeasons() {
        return $this->seasons;
    }
}