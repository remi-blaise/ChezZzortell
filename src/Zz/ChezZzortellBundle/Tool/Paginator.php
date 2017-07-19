<?php

namespace Zz\ChezZzortellBundle\Tool;

class Paginator extends \ArrayIterator
{
	protected $nbEntities;
	
	public function __construct ( array $entities, $nbEntities ) {
		$this->nbEntities = (int) $nbEntities;
		parent::__construct($entities);
	}
	
	public function count () {
		return $this->nbEntities;
	}
}