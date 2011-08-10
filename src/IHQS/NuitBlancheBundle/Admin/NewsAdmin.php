<?php

namespace IHQS\NuitBlancheBundle\Admin;

use WhiteOctober\AdminBundle\DataManager\Doctrine\ORM\Admin\DoctrineORMAdmin;

class NewsAdmin extends DoctrineORMAdmin
{
    protected function configure()
    {
	    $this->
			setName('News')->
			setDataClass('IHQS\NuitBlancheBundle\Entity\News')->
			addActions(array(
				'doctrine.orm.crud',
			))->
			setActionOption("list", "batch", false)->
			addFields(array(
				'title',
				'team',
				'body',
				'author',
				'date',
			))
		;

    }
}