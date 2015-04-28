<?php

namespace Zz\ChezZzortellBundle\Tests\Entity;

use Zz\ChezZzortellBundle\Entity\NoteManager;

class TestNoteManager extends NoteManager
{
	protected function getEntityName () {
		return 'Note';
	}
	
	protected function getResourcesDir () {
		return __DIR__ . '/Fixtures';
	}
	
	protected function getFolderName () {
		return 'tests';
	}
}