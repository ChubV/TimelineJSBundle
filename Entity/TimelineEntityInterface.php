<?php
namespace ChubProduction\TimelineJSBundle\Entity;

/**
 * Interface to interact with timelinejs service
 *
 * @author FrMn <v@chub.com.ua>
 */
interface TimelineEntityInterface
{
	/**
	 * Get type
	 */
	public function getType();

	/**
	 * Get Asset
	 */
	public function getAsset();

	/**
	 * Get startDate
	 */
	public function getStartDate();

	/**
	 * Get headline
	 */
	public function getHeadline();

	/**
	 * Get text
	 */
	public function getText();

	/**
	 * Get endDate
	 */
	public function getEndDate();

	/**
	 * Get tag
	 */
	public function getTag();
}