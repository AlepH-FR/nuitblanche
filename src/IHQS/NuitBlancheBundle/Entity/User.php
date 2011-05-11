<?php

namespace IHQS\NuitBlancheBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @orm:Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\UserRepository")
 * @orm:Table(name="user")
 */
class User implements UserInterface
{
	const STATUS_ONLINE		= "online";
	const STATUS_OFFLINE	= "offline";
	const STATUS_IDLE		= "idle";

    /**
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @orm:Column(type="string")
	 * @assertCustom:Unique(message = "This username is already used. Please choose another one")
	 * @assert:NotBlank()
	 * @assert:MinLength(4)
     */
    protected $username;

    /**
     * @orm:Column(type="string")
	 * @assert:NotBlank()
	 * @assert:MinLength(8)
     */
    protected $password;

    /**
     * @orm:Column(type="string")
	 * @assert:NotBlank()
	 * @assert:Email()
     */
    protected $email;
    
    /**
     * @orm:Column(type="string", nullable="true")
	 * @assert:File()
     */
    protected $avatar;

    /**
     * @orm:Column(type="string")
	 * @assert:NotBlank()
     */
    protected $firstName;

    /**
     * @orm:Column(type="string")
	 * @assert:NotBlank()
     */
    protected $lastName;

    /**
     * @orm:Column(type="string")
     */
    protected $city;

    /**
     * @orm:Column(type="string")
	 * @assert:NotBlank()
     */
    protected $country;

    /**
     * @orm:Column(type="string")
	 * @assert:Url()
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
	 * @assert:Email()
     */
    protected $msn;

    /**
     * @orm:OneToMany(targetEntity="News", mappedBy="author")
     */
    protected $news;

    /**
     * @orm:OneToMany(targetEntity="Replay", mappedBy="uploader")
     */
    protected $uploadedReplays;

    /**
     * @orm:Column(type="datetime")
     */
	protected $lastActivity;

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

    public function setAvatar(UploadedFile $avatar) {
		chmod($avatar->getPath(), 0777);
		
		$rootDir = __DIR__.'/../../../../web/';
		$dir = 'upload/avatar';
		$filename = strtolower($this->username) . '.' . pathinfo($avatar->getOriginalName(), PATHINFO_EXTENSION);

		$avatar->move($rootDir . $dir, $filename);
        $this->avatar = $dir . '/' . $filename;
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

	public function getLastActivity()
	{
		return $this->lastActivity;
	}

	public function setLastActivity(\DateTime $lastActivity)
	{
		$this->lastActivity = $lastActivity;
	}

	public function getStatus()
	{
		$diff = time() - $this->getLastActivity()->getTimestamp();
		if($diff < 600) { return self::STATUS_ONLINE; }
		if($diff < 900) { return self::STATUS_IDLE; }
		return self::STATUS_OFFLINE;
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

	static public function getRaces()
	{
		return array_keys(Player::$_sc2races);
	}
}