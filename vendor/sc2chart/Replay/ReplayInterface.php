<?php

namespace SC2Chart\Replay;

interface ReplayInterface
{
	function getFile();
	function getCTime();
	function getPlayers();
	function getMap();
	function getLength();
	function getRealm();
	function getVersion();
	function getBuild();
	function getChatLog();
}