<?php
namespace ChubProduction\TimelineJSBundle\Tests\Manager;
use ChubProduction\TimelineJSBundle\Manager\TimelineJSProviderInterface;
use ChubProduction\TimelineJSBundle\Tests\Service\Entity\GoodEntity;

/**
 * TestProvider
 *
 * @author Vladimir Chub <v@chub.com.ua>
 */
class TestProvider implements TimelineJSProviderInterface
{
	/**
	 * @return array
	 */
	public function getEntities()
	{
		return [new GoodEntity(), new GoodEntity()];
	}
}
