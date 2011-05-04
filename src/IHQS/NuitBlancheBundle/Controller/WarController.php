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
}
