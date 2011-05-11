<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlayerController extends Controller
{
    /**
     * @extra:Route("/player/{player_id}/show", name="player_show")
     * @extra:Template()
     */
    public function showAction($player_id)
    {
        return array(
            'player' => $this->get('nb.manager.player')->findOneById($player_id)
        );
    }

    /**
     * @extra:Route("/users", name="player_list")
     * @extra:Template("IHQSNuitBlancheBundle:Team:show.html.twig")
     */
    public function listAction()
    {
        $team = array(
            "name"  => "Website's",
            "tag"   => ""
        );
        $players = $this->get('nb.manager.player')->findAll();

        return array(
            'team'      => $team,
            'players'   => $players,
        );
    }
}
