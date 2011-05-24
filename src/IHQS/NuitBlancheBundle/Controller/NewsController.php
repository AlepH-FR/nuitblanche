<?php

namespace IHQS\NuitBlancheBundle\Controller;

use IHQS\NuitBlancheBundle\Entity\Comment;
use IHQS\NuitBlancheBundle\Entity\News;
use IHQS\NuitBlancheBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class NewsController extends BaseController
{
    protected function getFormComment(News $news, User $user)
    {
	// default object
        $comment = new Comment();
        $comment
            ->setDate(new \Datetime())
            ->setNews($news)
            ->setAuthor($user)
        ;

	// creating form
        $form = $this->get('form.factory')
            ->createBuilder('form', $comment)
            ->add('body')
            ->getForm();

		return $form;
	}

    /**
     * @Template()
     */
    public function _latestAction()
    {
        return array(
            'news' => $this->get('nb.manager.news')->findLatest()
        );
    }

    /**
     * @Template()
     */
    public function _commentAction($news)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        if(!$user instanceof User)
        {
            return array('not_connected' => true);
        }
		$form = $this->getFormComment($news, $user);

	// handling response
        return array(
            'not_connected'     => false,
            'submit_path'	=> $this->generateUrl('news_show', array('news_id' => $news->getId())),
            'form'		=> $form->createView()
        );
    }

    /**
     * @Route("/news/archives", name="news_archives")
     * @Template()
     */
    public function archivesAction()
    {
        return array(
            'news' => $this->get('nb.manager.news')->findLatest()
        );
    }
    
    /**
     * @Route("/news/{news_id}/show", name="news_show")
     * @Template()
     */
    public function showAction($news_id)
    {
	$news = $this->get('nb.manager.news')->findOneById($news_id);
        $user = $this->get('security.context')->getToken()->getUser();

        if($user instanceof User)
        {
            $form = $this->getFormComment($news, $user);

            // handling request
            $request = $this->get('request');
            if ($request->getMethod() == 'POST')
            {
                $form->bindRequest($request);

                // handling submission
                if($form->isValid())
                {
                    $comment = $form->getData();
                    $this->get('nb.entity_manager')->persist($comment);
                    $this->get('nb.entity_manager')->flush();
                }
            }
        }

        return array(
            'news' => $news
        );
    }

    /**
     * @Route("contribute/news/add", name="contribute_news_new")
     * @Route("contribute/news/{news_id}/edit", name="contribute_news_edit")
     * @Template("IHQSNuitBlancheBundle:Main:adminForm.html.twig")
     */
    public function newAction($news_id = null)
    {
        $user = $this->get('security.context')->getToken()->getUser();

        // creating default object
		if(!is_null($news_id))
		{
			$news = $this->get('nb.manager.news')->findOneById($news_id);
		}
		else
		{
			$news = new News();
			$news
				->setAuthor($user)
				->setDate(new \Datetime())
			;
		}

        // creating form
        $formType = $this->container->getParameter('nb.form.news.class');

        $form = $this->get('form.factory')->create(new $formType());
        $form->setData($news);

        return $this->_adminFormAction(
            'Add / Edit a news',
            $form,
            "News added"
        );
    }
}
