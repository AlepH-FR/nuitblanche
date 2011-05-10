<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use IHQS\NuitBlancheBundle\Entity\Game;
use IHQS\NuitBlancheBundle\Entity\Replay;

class ReplayController extends BaseController
{
    /**
     * @extra:Template()
     */
    public function _latestAction()
    {
        return array(
            'replays' => $this->get('nb.manager.replay')->findLatest()
        );
    }

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
     * @extra:Route("contribute/replay/add", name="contribute_replay_new")
     * @extra:Template("IHQSNuitBlancheBundle:Main:adminForm.html.twig")
     */
    public function newAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();

		// creating default object
		$game = new Game();
		$game->setDate(new \Datetime());

		$replay = new Replay();
		$replay->setGame($game);
		$replay->setUploader($user);
		$replay->setReplayProcessor($this->get('nb.replay.processor'));

		// creating form
        $formType = $this->container->getParameter('nb.form.replay.class');

		$form = $this->get('form.factory')->create(new $formType());
		$form->setData($replay);

		return $this->_adminFormAction('Add / Edit a replay', $form);
    }
}