<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReplayController extends Controller
{
    /**
     * @extra:Route("/replay/{replay_id}/show", name="replay_show")
     * @extra:Template()
     */
    public function showAction($replay_id)
    {
        return array(
            'replay' => $this->get('nb.replay.news')->findOneById($replay_id)
        );
    }
    /**
     * @extra:Route("/replay/{replay_id}/download", name="replay_file_download")
     * @extra:Template()
     */
    public function fileDownloadAction($replay_id)
    {
        return array(

        );
    }

    /**
     * @extra:Route("/replay/list", name="replay_list")
     * @extra:Template()
     */
    public function listAction()
    {
        return array(

        );
    }

    /**
     * @extra:Template()
     */
    public function latestAction()
    {
        return array(
            'replays' => $this->get('nb.manager.replay')->findLatest()
        );
    }
}
