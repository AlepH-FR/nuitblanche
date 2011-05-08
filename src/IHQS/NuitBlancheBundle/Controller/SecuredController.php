<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * @extra:Route("/secured")
 */
class SecuredController extends Controller
{
    /**
     * @extra:Route("/login", name="_demo_login")
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
