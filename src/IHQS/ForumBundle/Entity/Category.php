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
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function getId() {
        return $this->id;
    }
}