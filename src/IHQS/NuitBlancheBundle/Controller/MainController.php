<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    /**
     * @extra:Route("/", name="homepage")
     * @extra:Template()
     */
    public function indexAction()
    {
        return array(
            'news'  => $this->get('nb.manager.news')->findLast()
        );
    }

    /**
     * @extra:Route("/404", name="exception")
     * @extra:Template()
     */
    public function exceptionAction()
    {
        return array();
    }
}
