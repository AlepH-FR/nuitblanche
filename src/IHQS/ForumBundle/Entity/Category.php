<?php

namespace IHQS\ForumBundle\Entity;
use Bundle\ForumBundle\Entity\Category as BaseCategory;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Bundle\ForumBundle\Entity\CategoryRepository")
 * @ORM\Table(name="forum_category")
 */
class Category extends BaseCategory
{
	/**
	 * @ORM\OneToOne(targetEntity="Topic")
	 */
	protected $lastTopic;

	/**
	 * @ORM\OneToOne(targetEntity="Post")
	 */
	protected $lastPost;
}