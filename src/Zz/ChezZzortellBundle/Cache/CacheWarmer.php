<?php

namespace Zz\ChezZzortellBundle\Cache;

use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface;

class CacheWarmer implements CacheWarmerInterface
{
	protected $noteManager;
	
	public function __construct ( \Zz\ChezZzortellBundle\Entity\NoteManager $noteManager ) {
		$this->noteManager = $noteManager;
	}
	
	public function warmUp($cacheDir) {
		$this->noteManager->getEntities(0);
	}
	
	public function isOptional () {
		return true;
	}
}