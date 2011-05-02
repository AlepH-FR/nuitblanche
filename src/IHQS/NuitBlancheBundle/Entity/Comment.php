<?php

namespace IHQS\NuitBlancheBundle\Entity;

/**
 * @orm:Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\CommentRepository")
 */
class Comment
{
    /**
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @orm:Column(type="datetime")
     */
    protected $date;

    /**
     * @orm:Column(type="text")
     */
    protected $body;

    /**
     * @orm:ManyToOne(targetEntity="News")
     */
    protected $news;

    /**
     * @orm:ManyToOne(targetEntity="User")
     */
    protected $author;

    public function getId() {
        return $this->id;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getBody() {
        return $this->body;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function getNews() {
        return $this->news;
    }

    public function setNews(News $news) {
        $this->news = $news;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor(User $author) {
        $this->author = $author;
    }
}