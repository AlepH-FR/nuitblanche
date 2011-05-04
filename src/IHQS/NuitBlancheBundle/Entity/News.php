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
     */
    protected $title;

    /**
     * @orm:Column(type="text")
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
    }

    public function getBody() {
        return $this->body;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor(User $author) {
        $this->author = $author;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getTeam() {
        return $this->team;
    }

    public function setTeam($team) {
        $this->team = $team;
    }

    public function getComments() {
        return $this->comments;
    }
}
