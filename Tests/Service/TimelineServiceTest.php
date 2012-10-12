<?php
namespace ChubProduction\TimelineJSBundle\Tests\Service;

use ChubProduction\TimelineJSBundle\Tests\Service\Entity\GoodEntity;
use ChubProduction\TimelineJSBundle\Tests\Service\Entity\BadEntity;

/**
 * Timeline service test
 *
 * @author FrMn <v@chub.com.ua>
 */
class TimelineServiceTest extends \PHPUnit_Framework_TestCase
{
	private $container;
	private $client;

	/**
	 * Initialize test case
	 */
	public function setUp()
	{
		require_once __DIR__ . '/../Kernel/TestKernel.php';

		$kernel = new \TestKernel('test', false);
		$kernel->boot();

		$this->container = $kernel->getContainer();
	}

	/**
	 * Test of timeline entities to json conversion
	 */
	public function testTimelineService()
	{
		$ts = $this->get('timelinejs');

		$te = $this->createTestEntities();
		$timeline = $ts->createTimeline('myTimeline', $te);

		$this->assertFileExists(__DIR__ . '/../web' . $timeline->getFileName(), 'No timeline file exists');
		$this->assertTrue(strpos($timeline->getScript(), $timeline->getName() . '.json') !== false, 'Error when rendering script template');

		$arr = json_decode(file_get_contents(__DIR__ . '/../web' . $timeline->getFileName()));

		$this->assertObjectNotHasAttribute('asset', $arr);
		$this->assertEquals('1988,02,14', $arr->timeline->date[0]->endDate);
	}

	/**
	 * Test if exception thrown on bad entity
	 */
	public function testBadEntity()
	{
		$fail = true;

		try {
			$ts = $this->get('timelinejs');
			$ts->createTimeline('myTimeline', [new BadEntity(), new GoodEntity()]);
		} catch (\Exception $e) {
			$fail = false;
		}

		$this->assertFalse($fail, 'No exception on bad entity');
	}

	/**
	 * Test if exception thrown on no entity
	 */
	public function testNoItems()
	{
		$this->setExpectedException('ChubProduction\TimelineJSBundle\Exception\TimelineNoItemsException');

		$ts = $this->get('timelinejs');
		$ts->createTimeline('myTimeline', []);
	}

	/**
	 * Test if exception thrown on bad head number
	 */
	public function testBadArgumentEntity()
	{
		$this->setExpectedException('ChubProduction\TimelineJSBundle\Exception\TimelineBadArgumentsException');

		$ts = $this->get('timelinejs');
		$ts->createTimeline('myTimeline', $this->createTestEntities(), 'ololo');
	}

	/**
	 * Create an array of test entities
	 *
	 * @return array
	 */
	private function createTestEntities()
	{
		$te = [new GoodEntity(), new GoodEntity()];

		return $te;
	}

	/**
	 * Get smth from DIC
	 *
	 * @param string $id Identifier of smth
	 *
	 * @return mixed
	 */
	protected function get($id)
	{
		return $this->container->get($id);
	}

	/**
	 * Get client
	 *
	 * @return Client A Client instance
	 */
	protected function getClient()
	{
		return $this->client;
	}
}
