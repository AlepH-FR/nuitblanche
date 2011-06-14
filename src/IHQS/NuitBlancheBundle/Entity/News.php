<?php

namespace IHQS\NuitBlancheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\NewsRepository")
 * @ORM\Table(name="news")
 */
class News
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length="255")
     * @Assert\NotBlank()
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    protected $body;

    /**
     * @ORM\ManyToOne(targetEntity="User", cascade={"persist"})
     */
    protected $author;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @ORM\ManyToOne(targetEntity="Team", cascade={"persist"})
     */
    protected $team;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="news")
     */
    protected $comments;

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
		return $this;
    }

    public function getBody() {
        return $this->body;
    }

    public function setBody($body) {
        $this->body = $body;
		return $this;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor(User $author) {
        $this->author = $author;
		return $this;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate(\DateTime $date) {
        $this->date = $date;
		return $this;
    }

    public function getTeam() {
        return $this->team;
    }

    public function setTeam(Team $team) {
        $this->team = $team;
		return $this;
    }

    public function getComments() {
        return $this->comments;
    }

	public function getTeaser() {
		return substr($this->body, 0, strpos($this->body, '</p>'));
	}
}
