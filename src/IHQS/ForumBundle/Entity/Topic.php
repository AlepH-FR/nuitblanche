<?php

namespace IHQS\ForumBundle\Entity;

use Bundle\ForumBundle\Entity\Topic as BaseTopic;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Bundle\ForumBundle\Entity\TopicRepository")
 * @ORM\Table(name="forum_topic")
 */
class Topic extends BaseTopic
{
	/**
	 * @ORM\OneToOne(targetEntity="Post")
	 */
	protected $firstPost;

	/**
	 * @ORM\OneToOne(targetEntity="Post")
	 */
	protected $lastPost;

	/**
	 * @ORM\ManyToOne(targetEntity="Category")
	 */
	protected $category;
	
	/**
     * Get authorName
     * @return string
     */
    public function getAuthorName()
    {
        return $this->getFirstPost()->getAuthorName();
    }
}