<?php

namespace IHQS\NuitBlancheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserFormType extends AbstractType
{
	const PASSWORD_NESTED	= "nested";
	const PASSWORD_ALONE	= "alone";
	const PASSWORD_NONE		= "none";

	public static $_passwordModes = array(
		self::PASSWORD_NESTED,
		self::PASSWORD_ALONE,
		self::PASSWORD_NONE
	);

	private $displayPassword;

	public function __construct($displayPassword = self::PASSWORD_NESTED)
	{
		if(!in_array($displayPassword, self::$_passwordModes))
		{
			throw new \InvalidArgumentException("Password display mode '" . $displayPassword . "' unknown");
		}
		$this->displayPassword = $displayPassword;
	}

	public function buildForm(FormBuilder $builder, array $options)
	{
		if($this->displayPassword != self::PASSWORD_ALONE)
		{
			$builder->add('username');
		}

		if($this->displayPassword != self::PASSWORD_NONE)
		{
			$builder->add('password', 'repeated', array(
				'type'			=> 'password',
				'first_name'	=> 'Password',
				'second_name'	=> 'Repeat password'))
			;
		}

		if($this->displayPassword != self::PASSWORD_ALONE)
		{
			$builder
				->add('email')
				->add('avatar', 'file', array('type' => 'string'))
				->add('firstName')
				->add('lastName')
				->add('city')
				->add('country', 'country', array('preferred_choices' => array('FR', 'SE', 'DE')))
				->add('facebook')
				->add('skype')
				->add('twitter')
				->add('msn')
			;
		}
	}

	public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'IHQS\NuitBlancheBundle\Entity\User',
        );
    }
}