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

        );
    }

    /**
     * @extra:Route("/league/list", name="league_list")
     * @extra:Template()
     */
    public function listAction()
    {
        return array(

        );
    }
}
