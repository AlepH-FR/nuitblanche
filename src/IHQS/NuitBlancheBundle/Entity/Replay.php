<?php

namespace IHQS\NuitBlancheBundle\Entity;

use IHQS\NuitBlancheBundle\Replay\Processor;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @orm:Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\ReplayRepository")
 * @orm:Table(name="replay")
 */
class Replay
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
    protected $file;

    /**
     * @orm:Column(type="string")
     */
    protected $chart;

    /**
     * @orm:OneToOne(targetEntity="Game", cascade={"persist"})
     */
    protected $game;

    /**
     * @orm:Column(type="integer")
     */
    protected $size;
    
    /**
     * @orm:Column(type="string")
     */
    protected $length;
    
    /**
     * @orm:Column(type="string")
     */
    protected $obs;

    /**
     * @orm:Column(type="string")
     */
    protected $realm;

    /**
     * @orm:Column(type="string")
     */
    protected $version;

	/**
	 * @orm:Column(type="integer", nullable="true")
	 */
	protected $downloads;

    /**
     * @orm:Column(type="text")
     */
	protected $chatLog;

    /**
     * @orm:ManyToOne(targetEntity="Player")
     */
	protected $uploader;

	private $processor;

    public function getId() {
        return $this->id;
    }

    public function getFile() {
        return $this->file;
    }

    public function setFile(UploadedFile $file) {
		if(is_null($this->processor))
		{
			throw new \RuntimeException('No replay processor defined');
		}

		$this->processor->updateFile($this, $file);
		$this->downloads = 0;
    }

	public function doSetFile($file)
	{
		$this->file = $file;
	}

    public function getChart() {
        return $this->chart;
    }

    public function setChart($chart) {
        $this->chart = $chart;
    }

    public function getGame() {
        return $this->game;
    }

    public function setGame(Game $game) {
        $this->game = $game;
    }

    public function getSize() {
        return $this->size;
    }

    public function setSize($size) {
        $this->size = $size;
    }

    public function getLength() {
        return $this->length;
    }

    public function setLength($length) {
        $this->length = $length;
    }

    public function getObs() {
        return implode(', ', unserialize($this->obs));
    }

    public function setObs(array $obs) {
        $this->obs = serialize($obs);
    }

    public function getRealm() {
        return $this->realm;
    }

    public function setRealm($realm) {
        $this->realm = $realm;
    }

    public function getVersion() {
        return $this->version;
    }

    public function setVersion($version) {
        $this->version = $version;
    }

	public function getDownloads() {
		return $this->downloads;
	}

	public function incrementDownloads() {
		$this->downloads++;
	}

	public function getChatLog()
	{
		return unserialize($this->chatLog);
	}

	public function setChatLog(array $chatLog)
	{
		$this->chatLog = serialize($chatLog);
	}

	public function getUploader()
	{
		return $this->uploader;
	}

	public function setUploader(User $uploader)
	{
		$this->uploader = $uploader;
	}

	public function getNormalizedFileName() {
		$data = array();
		$data[] = $this->game->getDate()->format('Y-m-d');
		$data[] = '-';
		$data[] = $this->game->getTeam1Name();
		$data[] = 'vs';
		$data[] = $this->game->getTeam2Name();

		return implode(' ', $data).'.SC2Replay';
	}

	public function getNormalizedLength() {
		$secs = $this->getLength();

		$mins	= floor($secs / 60);
		$secs	= $secs % 60;

		$values = array();
		if ($mins > 0)	{ $values[] = $mins . ' mins'; }
		$values[] = $secs . ' secs';

		return implode(', ', $values);
	}

	public function setReplayProcessor(Processor $processor)
	{
		$this->processor = $processor;
	}
}
