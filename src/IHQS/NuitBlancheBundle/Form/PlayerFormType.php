<?php

namespace IHQS\NuitBlancheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use IHQS\NuitBlancheBundle\Entity\Player;

class PlayerFormType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder
			->add('user', new UserFormType())
			->add('sc2Id')
			->add('sc2Account')
			->add('sc2Race', 'choice', array('choices' => Player::$_sc2races))
			->add('sc2ProfileEsl')
			->add('sc2ProfilePandaria')
			->add('sc2ProfileSc2cl')
		;
	}

	public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'IHQS\NuitBlancheBundle\Entity\Player',
        );
    }
}