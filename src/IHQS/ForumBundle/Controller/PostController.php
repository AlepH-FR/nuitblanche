<?php

namespace IHQS\ForumBundle\Controller;

use Bundle\ForumBundle\Controller\PostController as BasePostController;
use Bundle\ForumBundle\Model\Topic;

class PostController extends BasePostController
{
    public function newAction(Topic $topic)
    {
		$posts = $this->get('forum.repository.post')->findAllByTopic($topic, true);
        $form = $this->get('forum.form.post');
        return $this->get('templating')->renderResponse('ForumBundle:Post:new.html.'.$this->getRenderer(), array(
            'form'  => $form->createView(),
            'topic' => $topic,
			'posts' => $posts
        ));
    }
}
