<?php

namespace IHQS\NuitBlancheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ReplayGameFormType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder
			->add('date')
			->add('warGame', null, array('required' => false, 'multiple' => false));
		;
	}

	public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'IHQS\NuitBlancheBundle\Entity\Game',
        );
    }
}