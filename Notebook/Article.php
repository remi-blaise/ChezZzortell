<?php

namespace Zz\ChezZzortellBundle\Notebook;

// use ;

class Article
{
	protected $id;
	protected $keywords;
	protected $creationDate;
	protected $modifDate;
	protected $content;
	
	public function __construct ( Array $properties ) {
		foreach ( $properties as $property => $value ) {
			$this->$property = $value;
		}
	}
	
	public function getId () {
		return $this->id;
	}
	public function getKeywords () {
		return $this->keywords;
	}
	public function getCreationDate () {
		return $this->creationDate;
	}
	public function getModifDate () {
		return $this->modifDate;
	}
	public function getContent () {
		return $this->content;
	}
}