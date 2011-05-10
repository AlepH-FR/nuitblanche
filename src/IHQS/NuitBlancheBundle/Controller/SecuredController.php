<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Component\Security\Core\SecurityContext;
use IHQS\NuitBlancheBundle\Entity\User;
use IHQS\NuitBlancheBundle\Entity\Player;

class SecuredController extends BaseController
{
    /**
     * @extra:Route("register", name="_secured_register")
     * @extra:Template("IHQSNuitBlancheBundle:Main:adminForm.html.twig")
     */
	public function registerAction()
	{
        $user = $this->get('security.context')->getToken()->getUser();

		// creating default object
		$user = new User();
		$player = new Player();
		$player->setUser($user);

		// creating form
        $formType = $this->container->getParameter('nb.form.player.class');

		$form = $this->get('form.factory')->create(new $formType());
		$form->setData($player);

		return $this->_adminFormAction('Register Nuit Blanche website', $form);
	}

    /**
     * @extra:Route("/login", name="_secured_login")
     * @extra:Template()
     */
    public function _loginAction()
    {
        if ($this->get('request')->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $this->get('request')->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $this->get('request')->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return array(
            'last_username' => $this->get('request')->getSession()->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        );
    }

    /**
     * @extra:Template()
     */
    public function _helloAction()
    {
        return array(
            'user' => $this->get('security.context')->getToken()->getUser()
        );
    }

    /**
     * @extra:Route("/login_check", name="_security_check")
     */
    public function securityCheckAction()
    {
        // The security layer will intercept this request
    }

    /**
     * @extra:Route("/logout", name="_security_logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }
}
