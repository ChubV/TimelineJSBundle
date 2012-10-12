<?php
namespace ChubProduction\TimelineJSBundle\Tests\Manager;
use ChubProduction\TimelineJSBundle\Manager\TimelineJSManager;

/**
 * TimelineMangerTest
 *
 * @author Vladimir Chub <v@chub.com.ua>
 */
class TimelineMangerTest extends \PHPUnit_Framework_TestCase
{
	public function testManager()
	{
		$manager = new TimelineJSManager();

		$tp = new TestProvider();
		$manager->addProvider($tp);
		$manager->addProvider($tp);

		$this->assertEquals($manager->getEntities(), array_merge($tp->getEntities(), $tp->getEntities()));
	}
}
