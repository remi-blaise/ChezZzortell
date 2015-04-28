<?php

namespace Zz\ChezZzortellBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Note
{
	/**
	 * @Assert\NotBlank
	 * @Assert\Type("integer")
	 */
	protected $id;
	/**
	 * @Assert\Type("array")
	 * @Assert\All({
	 * 		@Assert\Type("string")
	 * })
	 */
	protected $tags;
	/**
	 * @Assert\NotBlank
	 * @Assert\Date
	 */
	protected $creationDate;
	/**
	 * @Assert\Date
	 */
	protected $modifDate;
	/**
	 * @Assert\Type("string")
	 */
	protected $content;
	
	public function __construct ( array $datas ) {
		$this->hydrate($datas);
	}
	
	protected function hydrate ( array $datas ) {
		foreach ( $datas as $property => $value ) {
			if ( property_exists($this, $property) ) {
				$this->$property = $value;
			} else {
				throw new \InvalidArgumentException ('Attempt to set '.__class__.'::'.$property.' which doesn\'t exist.');
			}
		}
	}
	
	public function getDatas () {
		$prop = array();
		$prop['id'] = $this->getId();
		$prop['tags'] = $this->getTags();
		$prop['creationDate'] = $this->getCreationDate();
		$prop['modifDate'] = $this->getModifDate();
		$prop['content'] = $this->getContent();
		return $prop;
	}
	
	public function getId () {
		return $this->id;
	}
	public function getTags () {
		return $this->tags;
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