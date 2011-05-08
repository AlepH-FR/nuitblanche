<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
}
