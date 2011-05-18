<?php

namespace IHQS\NuitBlancheBundle\Controller;

use IHQS\NuitBlancheBundle\Entity\War;

class WarController extends BaseController
{
    /**
     * @extra:Route("/war/{war_id}/show", name="war_show")
     * @extra:Template()
     */
    public function showAction($war_id)
    {
        return array(
            'war' => $this->get('nb.manager.war')->findOneById($war_id)
        );
    }

    /**
     * @extra:Route("/war/list", name="war_list")
     * @extra:Template()
     */
    public function listAction()
    {
        return array(
            'wars' => $this->get('nb.manager.war')->findAll()
        );
    }

    /**
     * @extra:Template()
     */
    public function _latestAction()
    {
        return array(
            'wars' => $this->get('nb.manager.war')->findLatest()
        );
    }
	
	/**
     * @extra:Template()
     */
    public function _gamesAction($war_id)
    {
        return array(
            'war' => $this->get('nb.manager.war')->findOneById($war_id)
        );
    }

    /**
     * @extra:Template()
     */
    public function _calendarAction()
    {
        $dates = array();
        foreach(range(1, date('t')) as $i)
        {
            $dates[$i] = array("events" => array());
        }

        $wars = $this->get('nb.manager.war')->findByMonth(date('m'));
        foreach($wars as $war)
        {
            $key = (int) $war->getDate()->format('d');
            $dates[$key]["events"][] = array(
                "time"  => $war->getDate()->format('H:i'),
                "name"  => $war->getSeason()->getLeague()->getName(),
            );
        }
        
        return array(
            'dates' => $dates
        );
    }

    /**
     * @extra:Routes({
     *		@extra:Route("contribute/war/add", name="contribute_war_new"),
     *		@extra:Route("contribute/war/{war_id}/edit", name="contribute_war_edit")
     * })
     * @extra:Template("IHQSNuitBlancheBundle:Main:adminForm.html.twig")
     */
    public function newAction($war_id = null)
    {
		$war = null;
		if(!is_null($war_id))
		{
			$war = $this->get('nb.manager.war')->findOneById($war_id);
		}
		
		if(is_null($war))
		{
			$war = new War();
			$war->setDate(new \Datetime());
		}

        // creating form
        $formType = $this->container->getParameter('nb.form.war_new.class');
        $form = $this->get('form.factory')->create(new $formType(), $war);

        return $this->_adminFormAction(
            'Add / Edit a clan war',
            $form,
            "Clan war updated"
        );
    }

    /**
     * @extra:Route("contribute/war/games/{game_id}/edit", name="contribute_war_game")
     * @extra:Template("IHQSNuitBlancheBundle:War:gameForm.html.twig")
     */
	public function gameAction($game_id)
	{
		$game = $this->get('nb.manager.war_game')->findOneById($game_id);

        $formType = $this->container->getParameter('nb.form.war_game.class');
        $form = $this->get('form.factory')->create(new $formType(), $game);

        return $this->_adminFormAction(
            'Edit clan war game',
            $form,
            "Clan war game updated"
        );
	}
}
