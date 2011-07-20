<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PlayerController extends Controller
{
    /**
     * @Template()
     */
    public function _connectedAction()
    {
        return array(
            'players' => $this->get('nb.manager.player')->findConnected()
        );
    }

    /**
     * @Template()
     */
    public function _widgetAction($player_name)
    {
		$player = $this->get('nb.manager.player')->findOneBySc2Account($player_name);

        return array(
            'player' => $player,
			'playerName' => $player_name,
        );
    }

    /**
     * @Route("/player/{player_id}/show", name="player_show")
     * @Template()
     */
    public function showAction($player_id)
    {
        return array(
            'player' => $this->get('nb.manager.player')->findOneById($player_id)
        );
    }

    /**
     * @Route("/users", name="player_list")
     * @Template("IHQSNuitBlancheBundle:Team:show.html.twig")
     */
    public function listAction()
    {
        $team = array(
            "name"  => "Website's",
            "tag"   => ""
        );
        $players = $this->get('nb.manager.player')->findAll();

        return array(
            'teams'	=> $this->get('nb.manager.team')->findAll(),
            'team'      => $team,
            'players'   => $players,
            'stats'     => false
        );
    }
}
