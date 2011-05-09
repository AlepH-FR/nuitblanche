<?php

namespace SC2Chart\Charter;

use SC2Chart\Replay\ReplayInterface;

interface CharterInterface
{
	function create(ReplayInterface $replay, $filename, \SC2Chart $sc2chart);
}