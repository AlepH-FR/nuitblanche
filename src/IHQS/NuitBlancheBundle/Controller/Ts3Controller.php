<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class Ts3Controller extends Controller
{
	private $api_url = "ServerQuery://query:4quraYJK@ks364780.kimsufi.com:10011/?server_port=9987";

	protected function getChannelsInfo(array $channels)
	{
		$result = array();
		foreach($channels as $channel)
		{
			$channel_name = (string) $channel;
			if(!$channel_name) { continue; }
			
			$sub_channels = $channel->subChannelList();

			$clients = array();
			foreach($channel->clientList() as $client)
			{
				$name = (string) $client;
				if(strpos($name, ' ') !== false) { $name = substr($name, 0, strpos($name, ' ')); }
				$clients[$name] = $name;
			}
			
			$result[$channel_name] = array(
				'clients'	=> $clients,
				'channels'	=> $this->getChannelsInfo($sub_channels)
			);
		}

		return $result;
	}

    /**
     * @Template()
     */
	public function _channelsAction()
	{
		$message = '';
		
		try
		{
			$ts3 = \TeamSpeak3_TeamSpeak3::factory($this->api_url);
			$ts3->serverSelect(1);
			$channels = array($ts3->serverGetSelected()->channelGetByName('Nuit Blanche'));
			$channels = $this->getChannelsInfo($channels);
		}
		catch(\Exception $e)
		{
			$channels = array();
			$message  = 'Query over limit... please wait';
		}
		
		return array(
			'channels' => $channels,
			'message'  => $message,
		);
	}
}
