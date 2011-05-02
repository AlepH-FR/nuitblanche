<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TeamController extends Controller
{
    /**
     * @extra:Route("/team/{team_id}/show", name="team_show")
     * @extra:Template()
     */
    public function showAction($team_id)
    {
        return array(

        );
    }

    /**
     * @extra:Route("/team/list", name="team_list")
     * @extra:Template()
     */
    public function listAction()
    {
        return array(
            'teams' => $this->get('nb.manager.team')->findAll()
        );
    }
}
