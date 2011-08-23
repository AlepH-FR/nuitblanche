<?php

namespace IHQS\TournamentBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

abstract class RoundGroup implements RoundGroupInterface
{
    protected $round;

	protected $name;

	protected $matches;

	protected $players;

	public function __construct()
	{
		$this->matches = new ArrayCollection();
		$this->players = new ArrayCollection();
	}

	public function getRound()
	{
		return $this->round;
	}

	public function setRound(RoundInterface $round)
	{
		$this->round = $round;
	}
	
	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getMatches()
	{
		return $this->matches;
	}

	public function addMatch(MatchInterface $match)
	{
		$this->matches->add($match);
	}

	public function removeMatch(MatchInterface $match)
	{
		$this->matches->remove($match);
	}

	public function getPlayers()
	{
		return $this->players;
	}

	public function addPlayer(PlayerInterface $player)
	{
		$this->players->add($player);
	}

	public function removePlayer(PlayerInterface $player)
	{
		$this->players->remove($player);
	}
}