<?php

// +---------------------------------------------------------------------------+
// | This file is part of the AgaviPress package.                              |
// | Copyright (c) 2011-2010 the AgaviPress Project.                           |
// | Based on Agavi MVC Framework, Copyright (c) 2005-2011 the Agavi Project.  |
// |                                                                           |
// | For the full copyright and license information, please view the LICENSE   |
// | file that was distributed with this source code.                          |
// |   vi: set noexpandtab:                                                    |
// |   Local Variables:                                                        |
// |   indent-tabs-mode: t                                                     |
// |   End:                                                                    |
// +---------------------------------------------------------------------------+

/**
 * The manager model for configs.
 *
 * Note: Do not use this model to access config. Use AgaviPressConfig
 * instead.
 *
 * @package    agavi-press
 * @subpackage model
 *
 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
 * @copyright  Authors
 * @copyright  The AgaviPress Project
 *
 * @since      0.1.0
 *
 * @version    0.1.0
 */
class ConfigManagerModel extends AgaviPressManagerModel
{
	/**
	 * @var        array The configs cache.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0	 
	 */
	protected $configs = null;
	
	/**
	 * @var        array The configs record cache.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0	 
	 */	
	protected $records = array();
	
	/**
	 * Set a config value to the database. This method will create a record or 
	 * update an existing record. When updating a config, only the value can be 
	 * changed, not the format or the namespace.
	 *
	 * @param       string The name.
	 * @param       mixed The value.
	 * @param       string The namespace.
	 * @param       string The format of data, integer, string, array, object.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */	
	public function set($name, $value)
	{
		$config = $this->get($name);
		if ($config == null) {
			$config = new AgaviPress\Config();
			$config->setName($name);
		} else {
			$config = $this->records[$name];
		}
		
		$config->setValue($value);

		$this->persist($config);
		$this->flush();
		
		// cache it immediately
		$this->configs[$name] = $config->getValue();
		$this->records[$name] = $config;
	}

	/**
	 * Return a config record.
	 *
	 * @param       string The name.
	 * @param       string The namespace.
	 *
	 * @return      AgaviPress\Config The config record or null 
	 *                                if the record does not exists.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */		
	public function get($name, $default = null)
	{
		$this->load();
		
		return isset($this->configs[$name]) ? $this->configs[$name] : $default;
	}

	/**
	 * Indicate whether or not the config exists.
	 *
	 * @param       string The name.
	 * @param       string The namespace.
	 *
	 * @return      bool True if the config exists otherwise false.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */	
	public function has($name)
	{
		$this->load();
		
		return isset($this->configs[$name]);
	}
	
	/**
	 * Indicate whether or not the config exists.
	 *
	 * @param       string The name.
	 * @param       string The namespace.
	 *
	 * @return      bool True if the config exists otherwise false.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */	
	public function remove($name)
	{
		if (isset($this->configs[$name])) {
			unset($this->configs[$name]);
			unset($this->records[$name]);
			$this->createQuery('DELETE FROM AgaviPress\Config c WHERE c.name = :name')
				->setParameter('name', $name)
				->execute();
			return true;
		}		
		return false;
	}

	/**
	 * Load all the configs into the cache.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	protected function load()
	{
		if ($this->configs == null) {
			$this->configs = array();				
			$configs = $this->createQuery('SELECT c FROM AgaviPress\Config c')->getResult();
			foreach ($configs as $config) {
				$this->configs[$config->getName()] = $config->getValue();
				$this->records[$config->getName()] = $config;
			}
		}	
	}

	/**
	 * The doctrine php name of the table this model acts upon. 
	 *
	 * @return      string The table name.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	protected function getTableName()
	{
		return 'AgaviPress\Config';
	}
	
	/**
	 * The field that serves as the primary index.
	 *
	 * @return     string The index name.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0 
	 */
	protected function getIndexName()
	{
		return 'id';
	}
}