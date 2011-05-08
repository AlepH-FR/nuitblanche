<?php

namespace IHQS\NuitBlancheBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @orm:Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\UserRepository")
 * @orm:Table(name="user")
 */
class User implements UserInterface
{
    /**
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @orm:Column(type="string")
     */
    protected $username;

    /**
     * @orm:Column(type="string")
     */
    protected $password;

    /**
     * @orm:Column(type="string")
     */
    protected $email;
    
    /**
     * @orm:Column(type="string")
     */
    protected $avatar;

    /**
     * @orm:Column(type="string")
     */
    protected $firstName;

    /**
     * @orm:Column(type="string")
     */
    protected $lastName;

    /**
     * @orm:Column(type="string")
     */
    protected $city;

    /**
     * @orm:Column(type="string")
     */
    protected $country;

    /**
     * @orm:Column(type="string")
     */
    protected $facebook;

    /**
     * @orm:Column(type="string")
     */
    protected $twitter;

    /**
     * @orm:Column(type="string")
     */
    protected $skype;

    /**
     * @orm:Column(type="string")
     */
    protected $msn;

    /**
     * @orm:OneToMany(targetEntity="News", mappedBy="author")
     */
    protected $news;

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getAvatar() {
        return $this->avatar;
    }

    public function setAvatar($avatar) {
        $this->avatar = $avatar;
    }
    
    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getCountry() {
        return $this->country;
    }
    
    public function getCountryCode() {
        return strtoupper(substr($this->getCountry(), 0, 2));
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function getFacebook() {
        return $this->facebook;
    }

    public function setFacebook($facebook) {
        $this->facebook = $facebook;
    }

    public function getTwitter() {
        return $this->twitter;
    }

    public function setTwitter($twitter) {
        $this->twitter = $twitter;
    }

    public function getSkype() {
        return $this->skype;
    }

    public function setSkype($skype) {
        $this->skype = $skype;
    }

    public function getMsn() {
        return $this->msn;
    }

    public function setMsn($msn) {
        $this->msn = $msn;
    }

    public function getPublicMsn() {
        if(is_null($this->msn))  { return null; }

        list($account, $tld) = explode('@', $this->msn);
        list($domain, $region) = explode('.', $tld);

        return $account . '@' . substr($domain, 0, 1) . '....' . $region;
    }

    public function getRoles() {
        return array('ROLE_ADMIN');
    }

    public function getSalt() {
        return '';
    }

    public function eraseCredentials() {
        return true;
    }

    public function equals(UserInterface $user) {
        return ($user->getUsername() == $this->getUsername());
    }
}