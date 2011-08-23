<?php

namespace IHQS\TournamentBundle\RoundTypeManager;

use IHQS\TournamentBundle\Model\MatchInterface;
use IHQS\TournamentBundle\Model\RoundInterface;
use Doctrine\Common\Collections\Collection;
use IHQS\TournamentBundle\Entity\RoundGroup;
use IHQS\TournamentBundle\Entity\Match;

class SimpleBracketManager extends AbstractRoundTypeManager implements RoundTypeManagerInterface
{
	public function launch(Collection $roundPlayers)
	{
		$nb_phases = 0;
		while(pow(2, $nb_phases) < $this->round->getPlayerLimit())
		{
			$nb_phases++;
		}

		foreach(range(1, $nb_phases) as $i)
		{
			$nb_games = pow(2, $nb_phases - $i);
			switch($num_phase)
			{
				case 1:		$name = "Finals"; break;
				case 2:		$name = "Semi-finals"; break;
				default:	$name = 'round 1/' . $nb_games;
			}

			$g = new RoundGroup();
			$g->setName($name);
			$g->setRound($this->round);

			foreach(range(1, $nb_games) as $j)
			{
				$m = new Match();
				$m->setGroup($g);
				$g->addMatch($m);
				$m->setOrder($j);

				// TODO : sets players who should participate to this match
				if($i == 1)
				{
					$m->setPlayer1($player);
					$m->setPlayer2($opponent);
				}

				$this->om->persist($m);
			}

			$this->om->persist($g);
		}

		$this->om->flush();
	}

	public function close()
	{
		
	}

	public function closeMatch(MatchInterface $match, $player1Score, $player2Score)
	{
		$winner = $player1Score > $player2Score ? 1 : 2;

		$match->setPlayer1Score($player1Score);
		$match->setPlayer2Score($player2Score);
		$match->setWinner($winner);

		$this->om->persist($match);
		$this->om->flush();

		// TODO : add player to next game
	}
}
