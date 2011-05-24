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
            'news'  => $this->get('nb.manager.news')->findLast()
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
