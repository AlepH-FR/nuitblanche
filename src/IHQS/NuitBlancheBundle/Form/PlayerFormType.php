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
            ->add('user', new UserFormType($options['password']))
        ;

        if($options['password'] != UserFormType::PASSWORD_ALONE)
        {
            $builder
                ->add('sc2Id')
                ->add('sc2Account')
                ->add('sc2Race', 'choice', array('choices' => Player::$_sc2races))
                ->add('sc2ProfileEsl')
                ->add('sc2ProfilePandaria')
                ->add('sc2ProfileSc2cl')
            ;
        }
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class'	=> 'IHQS\NuitBlancheBundle\Entity\Player',
            'password'		=> UserFormType::PASSWORD_NESTED,
            'validation_groups'	=> $options['password'] == UserFormType::PASSWORD_ALONE ? 'Password' : 'Registration'
        );
    }

    public function getAllowedOptionValues(array $options)
    {
        return array(
            'password'	=> UserFormType::$_passwordModes,
        );
    }
}