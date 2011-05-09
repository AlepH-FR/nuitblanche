<?php

namespace SC2Chart\Analyzer\SC2Replay;

use SC2Chart\Replay\ReplayInterface;

class Replay extends \SC2Replay implements ReplayInterface
{
	private $playersInit = false;
	protected $playersProcessed;

	public function getCTime()
	{
		return new \DateTime($this->gameCtime);
	}

	public function getPlayers()
	{
		if(!$this->playersInit)
		{
			$this->initPlayers();
		}

		return $this->playersProcessed;
	}

	public function getMap()
	{
		return $this->getMapName();
	}

	public function getLength()
	{
		return $this->getGameLength();
	}

	public function getChatLog()
	{
		return $this->getMessages();
	}

	private function initPlayers()
	{
		foreach($this->getActualPlayers() as $player)
		{
			$processedPlayer = new Player();
			$processedPlayer
				->setName($player['name'])
				->setColor($player['color'])
				->setActions($player['apm'])
				->setRace($player['race'])
				->setTeam($player['team'])
				->setObs($player['isObs'])
				->setWinner($player['won'])
			;

			$this->playersProcessed[] = $processedPlayer;
		}

		$this->playersInit = true;
	}
}