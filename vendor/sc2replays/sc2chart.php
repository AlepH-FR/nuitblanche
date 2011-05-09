<?php

class SC2Chart
{
	const CHART_WIDTH   = 481;
	const CHART_HEIGTH  = 160;
	const PRECISION		= 5;

	private $_path;

	private $_replay;
	private $_players;
	private $_plots;
	private $_max_apms;

	private $_pix_per_seconds;
	private $_game_length;
	private $_file_name;

	public function __construct(SC2Replay $replay, $path = "")
	{
		$this->_path = $path;
		$this->_replay = $replay;
	}

	public function getFileName() { return $this->_file_name; }

	protected function _init()
	{
		$this->_file_name    = date('Ymd_Hi', $this->_replay->getCtime()) . '_';

		$players = $this->_replay->getActualPlayers();
		foreach($players as $player)
		{
			if (!$player['isObs'] && $player['ptype'] != 'Comp')
			{
				$this->_players[$player['name']] = $player;
				$this->_plots[$player['name']] = array();
				$this->_file_name .= $player['name'] . '_';
			}
		}

		$this->_file_name .= 'sc2chart.png';
		$this->_game_length      = $this->_replay->getGameLength();
		$this->_pix_per_seconds  = self::CHART_WIDTH / $this->_game_length;
	}

	protected function _parsePlayers()
	{
		foreach($this->_players as $player_name => $data)
		{
			$this->_parsePlayer($player_name);
		}
	}

	protected function _parsePlayer($player_name)
	{
		$values = $this->_players[$player_name]['apm'];

		foreach(range(self::PRECISION + 1, self::CHART_WIDTH, self::PRECISION) as $x)
		{
			$seconds_to_consider = ceil($x / $this->_pix_per_seconds);
			$apm = 0;

			// less than 60 seconds to consider for this pixel
			if ($seconds_to_consider < 60)
			{
				for ($tmp = 0; $tmp < $seconds_to_consider; $tmp++)
				{
					if (!isset($values[$tmp])){ continue; }
					$apm += $values[$tmp];
				}
				$apm = $apm / $seconds_to_consider * 60;
			}

			// more than 60 seconds to consider for this pixel
			else
			{
				for ($tmp = $seconds_to_consider - 60; $tmp < $seconds_to_consider; $tmp++)
				{
					if (!isset($values[$tmp])) { continue; }
					$apm += $values[$tmp];
				}
			}

			if($apm > $this->_max_apms[$player_name])
			{
				$this->_max_apms[$player_name] = $apm;
			}

			// adding point to the data
			$this->_plots[$player_name][$x] = $apm;
		}
	}

	public function populate()
	{
		$this->_init();
		$this->_parsePlayers();
		
		// creating image
		$pic = imagecreatetruecolor(self::CHART_WIDTH, self::CHART_HEIGTH);

		// allocating colors
		$black = imagecolorallocate($pic, 000, 000, 000);
		$gray  = imagecolorallocate($pic, 192, 192, 192);
		$white = imagecolorallocate($pic, 255, 255, 255);
		$white_a = imagecolorallocatealpha($pic, 255, 255, 255, 127);

		imagefill($pic, 0, 0, $white_a);

		// drawing player apm' plots
		$max_apm = max($this->_max_apms);

		$colors    =  array();
		$bg_colors = array();

		foreach($this->_plots as $player_name => $plots)
		{
			$color = $this->_players[$player_name]['color'];
			$r = hexdec(substr($color, 0, 2));
			$g = hexdec(substr($color, 2, 2));
			$b = hexdec(substr($color, 4, 2));

			$colors[$player_name]     = imagecolorallocate($pic, $r, $g, $b);
			$bg_colors[$player_name]  = imagecolorallocatealpha($pic, $r, $g, $b, 110);

			foreach(range(self::PRECISION + 1, self::CHART_WIDTH, self::PRECISION) as $i)
			{
				imagesetthickness($pic, 1);
				imagefilledpolygon(
					$pic,
					array(
						$i - self::PRECISION + 1, self::CHART_HEIGTH,
						$i - self::PRECISION + 1, self::CHART_HEIGTH - $plots[$i  - self::PRECISION],
						$i, self::CHART_HEIGTH - $plots[$i] / $max_apm * self::CHART_HEIGTH,
						$i, self::CHART_HEIGTH ,
					),
					4,
					$bg_colors[$player_name]
				);

				imagesetthickness($pic, 3);
				imageline(
					$pic,
					$i - self::PRECISION + 1,
					self::CHART_HEIGTH - $plots[$i - self::PRECISION] / $max_apm * self::CHART_HEIGTH,
					$i,
					self::CHART_HEIGTH - $plots[$i] / $max_apm * self::CHART_HEIGTH,
					$colors[$player_name]
				);
			}
		}

		// drawing graphic's frame
		$frame = imagecreatetruecolor(self::CHART_WIDTH + 39, self::CHART_HEIGTH + 20);

		// global frame
		imagefill($frame, 0, 0, $white);
		imagerectangle($frame, 25, 0, self::CHART_WIDTH + 25, self::CHART_HEIGTH, $gray);
		imageline($frame, 25, self::CHART_HEIGTH / 2, self::CHART_WIDTH + 25, self::CHART_HEIGTH / 2, $gray);

		// data values
		self::imagewrite($frame, 10, 8, self::CHART_HEIGTH - 0, "0", $black);
		self::imagewrite($frame, 10, 0, (self::CHART_HEIGTH / 2) + 5, floor($max_apm / 2), $black);
		self::imagewrite($frame, 10, 0, 10, floor($max_apm), $black);

		$length_minutes = ($this->_game_length / 60);
		for ($i = 0; $i < $length_minutes; $i+=5)
		{
			self::imagewrite($frame, 10, 25 + (self::CHART_WIDTH / ($length_minutes / 5) * ($i / 5)), self::CHART_HEIGTH + 12, $i . " min", $black);
			if ($i > 0)
			{
				imageline(
					$frame,
					25 + (self::CHART_WIDTH / ($length_minutes / 5) * ($i / 5)),
					0,
					25 + (self::CHART_WIDTH / ($length_minutes / 5) * ($i / 5)),
					self::CHART_HEIGTH,
					$gray
				);
			}
		}

		// copy the graph onto the container image and save it
		imagecopy($frame, $pic, 25, 0, 0, 0, self::CHART_WIDTH, self::CHART_HEIGTH);
		imagepng($frame, $this->_path . DS. $this->getFileName());
		imagedestroy($frame);
		imagedestroy($pic);
	}

	protected static function imagewrite($imgh, $size, $width, $height, $text, $color, $bold = false)
	{
		if(!function_exists("imagettftext"))
		{
			$size = floor($size / 4);
			imagestring($imgh, $size, $width, $height, $text, $color);
		}

		else
		{
			$font  = realpath(__DIR__ . '/fonts/Georgia.ttf');
			if($bold)
			{
			$font  = realpath(__DIR__ . '/fonts/GeorgiaB.ttf');
			}
			$angle = 0;
			imagettftext($imgh, $size, $angle, $width, $height, $color, $font, $text);
		}
	}
}
