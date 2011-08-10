<?php

namespace IHQS\NuitBlancheBundle\Admin;

use WhiteOctober\AdminBundle\DataManager\Doctrine\ORM\Admin\DoctrineORMAdmin;

class UserAdmin extends DoctrineORMAdmin
{
    protected function configure()
    {
	    $this->
			setName('Users')->
			setDataClass('IHQS\NuitBlancheBundle\Entity\User')->
			addActions(array(
				'doctrine.orm.crud',
			))->
			setActionOption("list", "batch", false)->
			addFields(array(
				'username',
				'email',
				'avatar',
				'firstName',
				'lastName',
				'city',
				'country',
				'facebook',
				'twitter',
				'msn',
			))
		;

    }
}