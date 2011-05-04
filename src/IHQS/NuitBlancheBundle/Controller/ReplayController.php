<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ReplayController extends Controller
{
    /**
     * @extra:Route("/replay/{replay_id}/show", name="replay_show")
     * @extra:Template()
     */
    public function showAction($replay_id)
    {
        return array(
            'replay' => $this->get('nb.manager.replay')->findOneById($replay_id)
        );
    }
    /**
     * @extra:Route("/replay/{replay_id}/download", name="replay_file_download")
     */
    public function fileDownloadAction($replay_id)
    {
		$replay = $this->get('nb.manager.replay')->findOneById($replay_id);
		$replay->incrementDownloads();

		$content = @file_get_contents($replay->getFile());
		if(false === $content)
		{
			throw new \RuntimeException('No file available for this given replay');
		}

		$em = $this->get('nb.entity_manager');
		$em->persist($replay);
		$em->flush();

		$response = new Response($content, 200);
		$response->headers->set('Content-Type', 'application/SC2Replay');
		$response->headers->set('Content-Disposition:', 'attachment; filename="' . $replay->getNormalizedFileName() . '"');

		return $response;
    }

    /**
     * @extra:Route("/replay/list", name="replay_list")
     * @extra:Template()
     */
    public function listAction()
    {
        return array(
            'replays' => $this->get('nb.manager.game')->findAllWithReplay()
        );
    }

    /**
     * @extra:Template()
     */
    public function _latestAction()
    {
        return array(
            'replays' => $this->get('nb.manager.replay')->findLatest()
        );
    }
}
