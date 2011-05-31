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
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function getId() {
        return $this->id;
    }

	/**
     * Get authorName
     * @return string
     */
    public function getAuthorName()
    {
        return $this->getFirstPost()->getAuthorName();
    }
}