<?php

namespace IHQS\NuitBlancheBundle\DataFixtures;

class BaseFixturesData
{
    protected $objects;
    protected $order;

    public function __construct()
    {
        $this->order   = array();
        $this->objects = array();
    }

    public function persistAll($manager)
    {
        foreach($this->order as $namespace)
        {
            print "\t. persisting " . $namespace . "\n";
            foreach($this->objects[$namespace] as $name => $o)
            {
                $manager->persist($o);
            }
        }
    }

    public function registerObjects($namespace, $objects)
    {
        if(!array_key_exists($namespace, $this->objects))
        {
            $this->objects[$namespace] = $objects;
        }

        else
        {
            $this->objects[$namespace] = array_merge($objects, $this->objects[$namespace]);
        }

        $this->{$namespace} =& $this->objects[$namespace];
        array_push($this->order, $namespace);
    }
}