<?php
namespace ChubProduction\TimelineJSBundle\Tests\Service\Entity;
use ChubProduction\TimelineJSBundle\Entity\TimelineEntityInterface;

/**
 * Good test entity class
 *
 * @author FrMn <v@chub.com.ua>
 */
class GoodEntity implements TimelineEntityInterface
{
	public function getType()
	{
		return 'date';

	}
	public function getAsset()
	{
		return array('ololo' => 'trololo');
	}
	public function getStartDate()
	{
		return '1988,02,13';
	}
	public function getHeadline()
	{
		return 'Happy birthday';
	}
	public function getText()
	{
		return 'Hello world';
	}
	public function getEndDate()
	{
		return \DateTime::createFromFormat('Y,m,d', '1988,02,14');
	}
	public function getTag()
	{
		return null;
	}
}
