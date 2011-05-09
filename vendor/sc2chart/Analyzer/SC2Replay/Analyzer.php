<?php

namespace SC2Chart\Analyzer\SC2Replay;

use SC2Chart\Analyzer\AbstractAnalyzer;
use SC2Chart\Analyzer\AnalyzerInterface;

class SC2ReplayAnalyzer extends AbstractAnalyzer implements AnalyzerInterface
{
	protected function buildReplay($replayFile)
	{
		$sc2replay = new Replay();
		$sc2replay->parse($replayFile);
		return $replay;
	}
}