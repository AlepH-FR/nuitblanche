<?php

namespace IHQS\NuitBlancheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ReplayFormType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder
			->add('file', 'file')
			->add('game', new ReplayGameFormType())
		;
	}

	public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'IHQS\NuitBlancheBundle\Entity\Replay',
        );
    }
}