<?php

namespace Zz\ChezZzortellBundle\Tests\Entity;

class ManagerTest extends \Symfony\Bundle\FrameworkBundle\Test\WebTestCase
{
    public function testGet()
    {
        $client = static::createClient();
		$container = $client->getContainer();
		...
        $this->assertEquals(true, true);
    }
}