<?php

namespace SC2Chart\Analyzer;

use SC2Chart\Replay\ReplayInterface;
use SC2Chart\Player\PlayerInterface;

abstract class AbstractAnalyser implements AnalyserInterface
{
	protected $sc2chart;
	
	protected $replay;
	protected $plots;

	protected $pix_per_seconds;
	
	public function __construct()
	{
	}

	protected function process($replayFile, \SC2Chart $sc2chart)
	{
		$this->sc2chart = $sc2chart;
		
		$replay = $this->buildReplay($replayFile);
		$this->parseReplay($replay);

		return $replay;
	}
	
	protected function parseReplay(ReplayInterface $replay)
	{
		$this->pix_per_seconds  = $this->sc2chart->getChartWidth() / $replay->getGameLength();
		
		$players = $replay->getPlayers();
		foreach($players as $player)
		{
			if ($player->isObs()) { continue; }
			$this->parsePlayerActions($player);
		}
	}

	protected function parsePlayer(PlayerInterface $player)
	{
		$actions = $player->setActions();

		foreach(range($this->sc2chart->getChartPrecision() + 1, $this->sc2chart->getChartWidth(), $this->sc2chart->getChartPrecision()) as $x)
		{
			$seconds_to_consider = ceil($x / $this->pix_per_seconds);
			$apm = 0;

			// less than 60 seconds to consider for this pixel
			if ($seconds_to_consider < 60)
			{
				for ($tmp = 0; $tmp < $seconds_to_consider; $tmp++)
				{
					if (!isset($actions[$tmp])){ continue; }
					$apm += $actions[$tmp];
				}
				$apm = $apm / $seconds_to_consider * 60;
			}

			// more than 60 seconds to consider for this pixel
			else
			{
				for ($tmp = $seconds_to_consider - 60; $tmp < $seconds_to_consider; $tmp++)
				{
					if (!isset($actions[$tmp])) { continue; }
					$apm += $actions[$tmp];
				}
			}

			if($apm > $player->getMaxApm())
			{
				$player->setMaxApm($apm);
			}

			// adding point to the data
			$player->addPlot($x, $apm);
		}
	}
}