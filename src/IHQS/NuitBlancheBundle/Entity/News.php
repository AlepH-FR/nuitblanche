<?php

namespace IHQS\NuitBlancheBundle\Entity;

/**
 * @orm:Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\NewsRepository")
 * @orm:Table(name="news")
 */
class News
{
    /**
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @orm:Column(type="string", length="255")
     * @assert:NotBlank()
     */
    protected $title;

    /**
     * @orm:Column(type="text")
     * @assert:NotBlank()
     */
    protected $body;

    /**
     * @orm:ManyToOne(targetEntity="User")
     */
    protected $author;

    /**
     * @orm:Column(type="datetime")
     */
    protected $date;

    /**
     * @orm:ManyToOne(targetEntity="Team")
     */
    protected $team;

    /**
     * @orm:OneToMany(targetEntity="Comment", mappedBy="news")
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
}
