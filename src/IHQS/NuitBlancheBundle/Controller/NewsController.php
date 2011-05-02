<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsController extends Controller
{
    /**
     * @extra:Route("/news/{news_id}/show", name="news_show")
     * @extra:Template()
     */
    public function showAction($news_id)
    {
        return array(
            'news' => $this->get('nb.manager.news')->findOneById($news_id)
        );
    }

    /**
     * @extra:Template()
     */
    public function latestAction()
    {
        return array(
            'news' => $this->get('nb.manager.news')->findLatest()
        );
    }
}
