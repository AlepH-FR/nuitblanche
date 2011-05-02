<?php

class WarGame
{
    private $id;
    protected $war;
    protected $games;
    
    public function getType()
    {
        switch(count($this->games[0]->players))
        {
            case 2: return self::TYPE_1v1;
            case 4: return self::TYPE_2v2;
            case 6: return self::TYPE_3v3;
            case 8: return self::TYPE_4v4;
        }

        throw new \RuntimeException('Invalid number of players for a game');
    }

    protected function getTeam($team_id)
    {
        $result = array();
        foreach($this->games[0]->players as $player)
        {
            if($player->getTeam() == $team_id)
            {
                array_push($result, $player);
            }
        }

        return $result;
    }

    public function getTeam1()
    {
        return $this->getTeam(1);
    }

    public function getTeam2()
    {
        return $this->getTeam(2);
    }

    protected function getTeamResult($team_id)
    {
        return ($this->winner == $team_id) ? self::RESULT_WIN : self::RESULT_LOSS;
    }

    public function getTeam1Result()
    {
        return $this->getTeamResult(1);
    }

    public function getTeam2Result()
    {
        return $this->getTeamResult(2);
    }

    public function getTeamRace($team_id)
    {
        $races = array();
        foreach($this->getTeam($team_id) as $player)
        {
            array_push($races, $player->getRace());
        }

        return implode('', $races);
    }

    public function getTeam1Race()
    {
        return $this->getTeamRace(1);
    }

    public function getTeam2Race()
    {
        return $this->getTeamRace(2);
    }

    public function getTeamName($team_id)
    {
        $races = array();
        foreach($this->getTeam($team_id) as $player)
        {
            array_push($races, $player->getName());
        }

        return implode(' ', $races);
    }

    public function getTeam1Name()
    {
        return $this->getTeamName(1);
    }

    public function getTeam2Name()
    {
        return $this->getTeamName(2);
    }

    public function getTeam1Score()
    {
        return ($this->getTeam1Result() == self::RESULT_WIN) ? 1 : 0;
    }

    public function getTeam2Score()
    {
        return ($this->getTeam2Result() == self::RESULT_WIN) ? 1 : 0;
    }
}