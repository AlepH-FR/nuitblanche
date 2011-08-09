<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MainController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        return array(
            'news'           => $this->get('nb.manager.news')->findLatest(false),
            'newsCommunity'  => $this->get('nb.manager.news')->findLatest(true)
        );
    }
    /**
     * @Route("/to_come", name="to_come")
     * @Template()
     */
    public function toComeAction()
    {
        return array(
            'items' => array(
                'v1.0' => array(
                    'forum',
                    'news edition form - wysiwyg'
                ),

                'v2.0' => array(
                    'comments edition',
                    'replay notes and comments',
                    'filters on replay and war lists',
                    'dumb stats page',
                    'backoffice for admins',
                )
            ),

            'ideas' => array(
                'add team baseline to the banner "fair gamers since 1996"',
                'remake team logos for other websites',
                'add Atom or RSS feeds',
                'news on facebook'
            ),
        );
    }

    /**
     * @Route("/404", name="exception")
     * @Template()
     */
    public function exceptionAction()
    {
        return array();
    }
}
