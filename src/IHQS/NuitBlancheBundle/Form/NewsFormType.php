<?php

namespace IHQS\NuitBlancheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class NewsFormType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('team', 'entity', array(
                'required' => false,
                'class'    => 'IHQS\NuitBlancheBundle\Entity\Team',
            ))
            ->add('teamGame')
            ->add('lang', 'choice', array('choices' => array('uk' => 'en', 'fr' => 'fr')))
            ->add('body', new WysiwygTextareaType());
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'IHQS\NuitBlancheBundle\Entity\News',
        );
    }
}