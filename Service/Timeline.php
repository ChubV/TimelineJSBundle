<?php
namespace ChubProduction\TimelineJSBundle\Service;
use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * TimelineJS manager class
 *
 * @author FrMn <v@chub.com.ua>
 */
class Timeline
{
	private $fileName;
	private $name;

	/**
	 * @return the $name
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param field_type $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @param array $arguments arguments to create script with
	 *
	 * @return array $script
	 */
	public function getScript($arguments = array())
	{
		$args = array('width' => '100%', 'height' => 600, 'source' => $this->fileName);

		foreach (array('width', 'height', 'embed_id',
						'start_at_end', 'start_at_slide',
						'start_zoom_adjust', 'hash_bookmark',
						'font', 'debug', 'lang', 'maptype', 'css', 'js') as $arg) {
			if (isset($arguments[$arg])) {
				$args[$arg] = $arguments[$arg];
			}
		}
		$script = '<script>createStoryJS(' . json_encode($args) . ');</script>';

		return $script;
	}

	/**
	 * @return the $fileName
	 */
	public function getFileName()
	{
		return $this->fileName;
	}

	/**
	 * @param field_type $fileName
	 */
	public function setFileName($fileName)
	{
		$this->fileName = $fileName;
	}
}
