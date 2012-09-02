<?php
namespace ChubProduction\TimelineJSBundle\Service;

/**
 * TimelineJS service interface
 *
 * @author FrMn <v@chub.com.ua>
 */
interface TimelinejsInterface
{
	/**
	 * Create timeline object for a given items
	 *
	 * @param string $name  The name of the timeline
	 * @param array  $items Items to process
	 * @param number $head  Item number to set as head one
	 *
	 * @return Timeline
	 */
	public function createTimeline($name, array $items, $head);
}