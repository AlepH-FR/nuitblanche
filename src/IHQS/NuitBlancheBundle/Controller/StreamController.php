<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StreamController extends Controller
{
	private $api_url = 'http://xnuitblanchegamingx.api.channel.livestream.com/2.0/';

	private function request($method, $format = "json")
	{
		$content = file_get_contents($this->api_url . $method . "." . $format);
		$data = json_decode($content);

		return $data;
	}

    /**
     * @extra:Template()
     */
    public function _statusAction()
    {
		$data = $this->request('info');
		
        return array(
            'live'  => $data->channel->isLive
        );
    }
}