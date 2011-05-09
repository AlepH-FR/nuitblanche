<?php

namespace SC2Chart\Player;

abstract class AbstractPlayer implements PlayerInterface
{
	protected $name;
	protected $apm;
	protected $maxApm;
	protected $color;
	protected $race;
	protected $team;
	protected $isObs;
	protected $isWinner;
	protected $plots = array();

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	public function getApm()
	{
		return $this->apm;
	}

	public function setApm($apm)
	{
		$this->apm = $apm;
		return $this;
	}

	public function getMaxApm()
	{
		return $this->maxApm;
	}

	public function setMaxApm($maxApm)
	{
		$this->maxApm = $maxApm;
		return $this;
	}

	public function getColor()
	{
		return $this->color;
	}

	public function setColor($color)
	{
		$this->color = $color;
		return $this;
	}

	public function getRace()
	{
		return $this->race;
	}

	public function setRace($race)
	{
		$this->race = $race;
		return $this;
	}

	public function getTeam()
	{
		return $this->team;
	}

	public function setTeam($team)
	{
		$this->team = $team;
		return $this;
	}

	public function isObs()
	{
		return ($this->isObs);
	}

	public function setObs($isObs)
	{
		$this->isObs = ($isObs);
		return $this;
	}

	public function isWinner()
	{
		return ($this->isWinner);
	}

	public function setWinner($isWinner)
	{
		$this->isWinner = ($isWinner);
		return $this;
	}

	public function getPlots()
	{
		return $this->plots;
	}

	public function addPlot($x, $value)
	{
		$this->plots[$x] = $value;
		return $this;
	}
}