<?php

namespace SC2Chart\Player;

interface PlayerInterface
{
	function getName();
	function getApm();
	function getMaxApm();
	function getColor();
	function getRace();
	function getTeam();
	function isObs();
	function isWinner();
	function addPlot($x, $y);
	function getPlots();
}