<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;

class BaseController extends Controller
{
	protected function _adminFormAction($title, FormInterface $form)
	{
		$message = '';

		// handling request
		$request = $this->get('request');
		if ($request->getMethod() == 'POST')
		{
			$form->bindRequest($request);

			// handling submission
			if($form->isValid())
			{
				$object = $form->getData();
				$this->get('nb.entity_manager')->persist($object);
				$this->get('nb.entity_manager')->flush();
			}
			else
			{
				$message = 'Form was not validated';
			}
		}

		return array(
			'title'		=> $title,
			'form'		=> $form->createView(),
			'message'	=> $message,
		);
	}
}