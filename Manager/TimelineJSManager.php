<?php
namespace ChubProduction\TimelineJSBundle\Manager;

/**
 * TimelineJSManager
 *
 * @author Vladimir Chub <v@chub.com.ua>
 */
class TimelineJSManager
{
	private $providers = array();

	/**
	 * Add provider to a provider chain
	 *
	 * @param TimelineJSProviderInterface $provider
	 */
	public function addProvider(TimelineJSProviderInterface $provider)
	{
		$this->providers[] = $provider;
	}

	/**
	 * Merges all provided entities
	 */
	public function getEntities()
	{
		$res = array();

		/** @var TimelineJSProviderInterface $provider */
		foreach ($this->providers as $provider) {
			$res = array_merge($res, $provider->getEntities());
		}

		return $res;
	}
}
