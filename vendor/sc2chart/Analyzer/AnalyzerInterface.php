<?php

namespace SC2Chart\Analyzer;

use SC2Chart\Replay\ReplayInterface;
use SC2Chart\Player\PlayerInterface;

interface AnalyzerInterface
{
	function process($replayFile, \SC2Chart $sc2chart);
	function buildReplay();
	function parseReplay(ReplayInterface $replay);
	function parsePlayer(PlayerInterface $player);
}
