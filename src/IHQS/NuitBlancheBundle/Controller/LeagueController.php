<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LeagueController extends Controller
{
    /**
     * @extra:Route("/league/{league_id}/show", name="league_show")
     * @extra:Template()
     */
    public function showAction($league_id)
    {
        return array(
            'league' => $this->get('nb.manager.league')->findOneById($league_id)
        );
    }

    /**
     * @extra:Route("/season/{season_id}/show", name="season_show")
     * @extra:Template()
     */
    public function seasonShowAction($season_id)
    {
        return array(
            'season' => $this->get('nb.manager.season')->findOneById($season_id)

        );
    }

    /**
     * @extra:Route("/league/list", name="league_list")
     * @extra:Template()
     */
    public function listAction()
    {
        return array(
            'leagues' => $this->get('nb.manager.league')->findAll()
        );
    }
}
