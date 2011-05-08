<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IHQS\NuitBlancheBundle\Entity\Comment;
use IHQS\NuitBlancheBundle\Entity\User;

class NewsController extends Controller
{
    /**
     * @extra:Template()
     */
    public function _latestAction()
    {
        return array(
            'news' => $this->get('nb.manager.news')->findLatest()
        );
    }

    /**
     * @extra:Template()
     */
    public function _commentAction($news)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        if(!$user instanceof User)
        {
            return array('not_connected' => true);
        }

        $comment = new Comment();
        $comment
            ->setDate(new \Datetime())
            ->setNews($news)
            ->setAuthor($user)
        ;

        $form = $this->get('form.factory')
            ->createBuilder('form', $comment)
            ->add('body')
            ->getForm();

        return array(
            'not_connected' => false,
            'form' => $form->createView()
        );
    }

    
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
     * @extra:Route("contribute/news/add", name="contribute_news_new")
     * @extra:Template()
     */
    public function newAction()
    {
        return array(

        );
    }
}
