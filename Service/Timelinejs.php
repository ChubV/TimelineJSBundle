<?php
namespace ChubProduction\TimelineJSBundle\Service;

use ChubProduction\TimelineJSBundle\Exception\TimelineBadArgumentsException;
use ChubProduction\TimelineJSBundle\Exception\TimelineNoItemsException;
use ChubProduction\TimelineJSBundle\Exception\TimelineInvalidInputException;
use ChubProduction\TimelineJSBundle\Entity\TimelineEntityInterface;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * TimelineJS manager class
 *
 * @todo cache
 *
 * @author FrMn <v@chub.com.ua>
 */
class Timelinejs implements TimelinejsInterface
{
	private $webPath;

	/**
	 * Class constructor
	 *
	 * @param string $web Project web path
	 */
	public function __construct($web)
	{
		$this->webPath = $web;
		if (!is_dir($web . '/timelinejs')) {
			mkdir($web . '/timelinejs', 0644);
		}
	}

	/**
	 * (non-PHPdoc)
	 * @see ChubProduction\TimelineJSBundle\Service\TimelinejsInterface::createTimeline()
	 */
	public function createTimeline($name, array $items, $head = 0)
	{
		if (!is_numeric($head)) {
			throw new TimelineBadArgumentsException('Head element index is not numeric');
		}

		if (count($items) < 2 || !isset($items[$head])) {
			throw new TimelineNoItemsException('Tere must be at least 2 items passed to createTimeline');
		}

		$webPath = '/timelinejs/' . $name . '.json';

		$fname = $this->webPath . $webPath;

		$json = $this->toJson($items, $head);
		file_put_contents($fname, $json);

		$tl = new Timeline();
		$tl->setFileName($webPath);
		$tl->setName($name);

		return $tl;
	}

	/**
	 * Convert items to timeline JSON
	 *
	 * @param array $items Elements array
	 * @param mixed $head  Head element or null to take first item instead
	 *
	 * @throws TimelineInvalidInputException
	 * @return string
	 */
	protected function toJson($items, $head)
	{
		$res = array();

		$res['timeline'] = $this->toArray($items[$head]);
		$res['timeline']['type'] = 'default';
		unset($items[$head]);

		foreach ($items as $item) {
			$type = 'date';
			if (in_array($item->getType(), array('date', 'era'))) {
				$type = $item->getType();
			}

			$res['timeline'][$type][] = $this->toArray($item);
		}

		return json_encode($res);
	}

	/**
	 * Convert timeline item to timeline JSON
	 *
	 * @param TimelineEntityInterface $item
	 *
	 * @return array
	 */
	protected function toArray(TimelineEntityInterface $item)
	{
		$res = array();
		foreach (array('startDate', 'headline', 'text', 'endDate', 'tag') as $key) {
			$getter = 'get' . ucfirst($key);
			$val = $item->$getter();
			if ($val != null) {
				if ($val instanceof \DateTime) {
					$res[$key] = $val->format('Y,m,d');
				} else {
					$res[$key] = (string) $val;
				}
			}
		}

		$asset = $item->getAsset();

		foreach ( array('media', 'thumbnail', 'credit', 'caption') as $key) {
			if (isset($asset[$key]) && $asset[$key] != null) {
				$val = $asset[$key];

				if ($val instanceof \DateTime) {
					$res['asset'][$key] = $val->format('Y,m,d');
				} else {
					$res['asset'][$key] = (string) $val;
				}
			}
		}

		return $res;
	}
}