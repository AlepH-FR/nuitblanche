<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IHQS\NuitBlancheBundle\Entity\War;

class WarController extends Controller
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
     * @extra:Route("contribute/war/add", name="contribute_war_new")
     * @extra:Template("IHQSNuitBlancheBundle:Main:adminForm.html.twig")
     */
    public function newAction()
    {
        // creating default object
        $war = new War();

	// creating form
        $formType = $this->container->getParameter('nb.form.war.class');

        $form = $this->get('form.factory')->create(new $formType());
        $form->setData($replay);

        return $this->_adminFormAction(
            'Add / Edit a clan war',
            $form,
            "Clan war added to the database"
        );
    }
}
