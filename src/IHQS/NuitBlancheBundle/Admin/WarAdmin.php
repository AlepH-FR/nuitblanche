<?php

namespace IHQS\NuitBlancheBundle\Admin;

use WhiteOctober\AdminBundle\DataManager\Doctrine\ORM\Admin\DoctrineORMAdmin;

class WarAdmin extends DoctrineORMAdmin
{
    protected function configure()
    {
	    $this->
			setName('Wars')->
			setDataClass('IHQS\NuitBlancheBundle\Entity\War')->
			addActions(array(
				'doctrine.orm.crud',
			))->
			setActionOption("list", "batch", false)->
			addFields(array(
				'date',
				'maps',
				'team',
				'season',
				'teamScore',
				'opponentScore',
				'opponentName',
				'opponentCountry',
				'result',
				'games',
			))
		;

    }
}