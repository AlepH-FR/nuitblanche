<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use IHQS\NuitBlancheBundle\Entity\User;
use IHQS\NuitBlancheBundle\Entity\Player;
use IHQS\NuitBlancheBundle\Form\UserFormType;

class SecuredController extends BaseController
{
    /**
     * @Route("register", name="_secured_register")
     * @Template("IHQSNuitBlancheBundle:Main:adminForm.html.twig")
     */
    public function registerAction()
    {
        // creating default object
        $user = new User();
        $player = new Player();
        $player->setUser($user);

        // creating form
        $formType = $this->container->getParameter('nb.form.player.class');

        $form = $this->get('form.factory')->create(new $formType());
        $form->setData($player);

        return $this->_adminFormAction(
            'Register Nuit Blanche website',
            $form,
            "Thx for you registration. You can now log on the website.",
            true
        );
    }

    /**
     * @Route("profile/edit", name="_secured_profile_edition")
     * @Template("IHQSNuitBlancheBundle:Main:adminForm.html.twig")
     */
    public function profileEditionAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
		$player = $user->getPlayer();
		
        // creating form
        $formType = $this->container->getParameter('nb.form.player.class');

        $form = $this->get('form.factory')->create(new $formType(), $player, array('password' => UserFormType::PASSWORD_NONE));

        return $this->_adminFormAction(
            'Edit my profile',
            $form,
            "Your profile has been updated",
            true
        );
    }

    /**
     * @Route("profile/password", name="_secured_profile_password")
     * @Template("IHQSNuitBlancheBundle:Main:adminForm.html.twig")
     */
    public function profilePasswordAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
		$player = $user->getPlayer();

        // creating form
        $formType = $this->container->getParameter('nb.form.player.class');

        $form = $this->get('form.factory')->create(new $formType(), $player, array('password' => UserFormType::PASSWORD_ALONE));

        return $this->_adminFormAction(
            'Change my password',
            $form,
            "Your password has been changed successfully.",
            true
        );
    }

    /**
     * @Route("/login", name="_secured_login")
     * @Template()
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
     * @Template()
     */
    public function _helloAction()
    {
        return array(
            'user' => $this->get('security.context')->getToken()->getUser()
        );
    }

    /**
     * @Route("/login_check", name="_security_check")
     */
    public function securityCheckAction()
    {
        // The security layer will intercept this request
    }

    /**
     * @Route("/logout", name="_security_logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }
}
