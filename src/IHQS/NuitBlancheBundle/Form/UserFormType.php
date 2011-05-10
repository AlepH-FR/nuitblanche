<?php

namespace IHQS\NuitBlancheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserFormType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder
			->add('username')
			->add('password', 'repeated', array(
				'type'			=> 'password',
				'first_name'	=> 'Password',
				'second_name'	=> 'Repeat password'))
			->add('email')
			->add('avatar', 'file', array('type' => null))
			->add('firstName')
			->add('lastName')
			->add('city')
			->add('country', 'country', array('preferred_choices' => array('FR', 'SE')))
			->add('facebook')
			->add('skype')
			->add('twitter')
			->add('msn')
		;
	}

	public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'IHQS\NuitBlancheBundle\Entity\User',
        );
    }
}