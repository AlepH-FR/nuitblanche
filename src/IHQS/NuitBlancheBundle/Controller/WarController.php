<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WarController extends Controller
{
    /**
     * @extra:Route("/war/{war_id}/show", name="war_show")
     * @extra:Template()
     */
    public function showAction($player_id)
    {
        return array(

        );
    }

    /**
     * @extra:Route("/war/list", name="war_list")
     * @extra:Template()
     */
    public function listAction()
    {
        return array(

        );
    }

    /**
     * @extra:Template()
     */
    public function latestAction()
    {
        return array(
            'wars' => $this->get('nb.manager.war')->findLatest()
        );
    }
}
