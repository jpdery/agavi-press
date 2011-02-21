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
 * AgaviPressConfig is used to access configs in org.agavi-press.config.
 *
 * Config values can be set from the database and from settings.xml. However,
 * when a config is set in settings.xml, its value will override the database
 * counterpart.
 *
 * @package    agavi
 * @subpackage config
 *
 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
 * @copyright  Authors
 * @copyright  The AgaviPress Project
 *
 * @since      0.1.0
 *
 * @version    0.1.0
 */
class AgaviPressConfig extends AgaviConfig
{
	const PREFIX = 'org.agavi-press.config.';

	/**
	 * Get a config value locally or from the database.
	 *
	 * @param      string The name of the configuration directive.
	 *
	 * @return     mixed The value of the directive, or null if not set.
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>	 
	 */
	public static function get($name, $default = null)
	{
		$name = self::PREFIX . $name;
		
		$config = AgaviConfig::get($name);
		if ($config == null) {
			$config = AgaviPressConfig::getConfigManager()->get($name, $default);
		}

		return $config;
	}

	/**
	 * Check if a configuration directive has been set locally or from the
	 * database.
	 *
	 * @param      string The name of the configuration directive.
	 *
	 * @return     bool Whether the directive was set.
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 */
	public static function has($name)
	{
		$name = self::PREFIX . $name;

		$exists = AgaviConfig::has($name);
		if ($exists == false) {
			$exists = AgaviPressConfig::getConfigManager()->has($name);
		}

		return $exists;
	}

	/**
	 * Set a configuration value locally.
	 *
	 * @param      string The name of the configuration directive.
	 * @param      string The value of the configuration directive.
	 *
	 * @return     bool Whether or not the configuration directive has been set.	 
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>	 
	 */
	public static function set($name, $value)
	{
		return AgaviConfig::set(self::PREFIX . $name, $value);
	}

	/**
	 * Remove a configuration value locally.
	 *
	 * @param      string The name of the configuration directive.
	 *
	 * @return     bool Whether the configuration was removed.
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>	
	 */
	public static function remove($name)
	{	
		return AgaviConfig::remove(self::PREFIX . $name);
	}
	
	/**
	 * Return an instance of the config manager.
	 *
	 * @return     ConfigManager The instance of the config manager.
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>	 
	 */	
	public static function getConfigManager()
	{
		static $configManager = null;
	
		if ($configManager == null) {
			$configManager = AgaviContext::getInstance(CONTEXT)->getModel('ConfigManager');
		}
		
		return $configManager;
	}	
}