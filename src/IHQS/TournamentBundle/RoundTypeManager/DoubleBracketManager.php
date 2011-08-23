<?php

namespace IHQS\TournamentBundle\RoundTypeManager;

use IHQS\TournamentBundle\Model\MatchInterface;
use IHQS\TournamentBundle\Model\RoundInterface;
use Doctrine\Common\Collections\Collection;
use IHQS\TournamentBundle\Entity\RoundGroup;

class DoubleBracketManager extends AbstractRoundTypeManager implements RoundTypeManagerInterface
{
	function launch(Collection $players)
	{

	}

	function close()
	{

	}

	function closeMatch(MatchInterface $match, $player1Score, $player2Score)
	{

	}
}
