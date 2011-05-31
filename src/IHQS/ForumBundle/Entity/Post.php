<?php

namespace IHQS\ForumBundle\Entity;
use Bundle\ForumBundle\Entity\Post as BasePost;
use Doctrine\ORM\Mapping as ORM;
use IHQS\NuitBlancheBundle\Entity\User;

/**
 * @ORM\Entity(repositoryClass="Bundle\ForumBundle\Entity\PostRepository")
 * @ORM\Table(name="forum_post")
 */
class Post extends BasePost
{
	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

	/**
	 * @ORM\ManyToOne(targetEntity="IHQS\NuitBlancheBundle\Entity\User")
	 */
	protected $author;

    public function getId() {
        return $this->id;
    }

	public function getAuthor()
	{
		return $this->author;
	}

	public function setAuthor(User $author)
	{
		$this->author = $author;
	}

	public function getAuthorName()
	{
		return ($this->author instanceof User) ? $this->author->getUsername() : 'Anonymous';
	}

}