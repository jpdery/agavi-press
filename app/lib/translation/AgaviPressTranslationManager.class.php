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
 * Add methods to the original translation manager.
 * 
 * The translation manager manages the interface between the application and the
 * current translation engine implementation
 *
 * @package    agavi-press
 * @subpackage translation
 *
 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
 * @copyright  Authors
 * @copyright  The AgaviPress Project
 *
 * @since      0.1.0
 *
 * @version    0.1.0
 */
class AgaviPressTranslationManager extends AgaviTranslationManager
{
	/**
	 * Return an array that contains the common short language code for
	 * each available locales.
	 *
	 * @return     array An array of the available languages.
	 * 
	 * @author     Jean-Philippe Dery <jean-philippe.dery@gmail.com>
	 * @since      0.1.0
	 */	
	public function getAvailableLanguages()
	{
		$languages = array();		
		foreach ($this->getAvailableLocales() as $locale) {
			
			$code = $locale['identifierData']['language'];
			
			if (isset($languages[$code])) {
				$languages[$code]['locales'][] = $locale['identifierData']['locale_str'];				
			} else {
				$languages[$code] = array(
					'code'    => $code,
					'name'    => $locale['parameters']['description'],
					'locales' => array(
						$locale['identifierData']['locale_str']							
					)
				);				
			}
		}
		
		return $languages;
	}
	
	/**
	 * Return an array that contains languages selected by the user.
	 *
	 * @return     array An array of the languages.
	 * 
	 * @author     Jean-Philippe Dery <jean-philippe.dery@gmail.com>
	 * @since      0.1.0
	 */		
	public function getSelectedLanguages()
	{
		$codes = explode(',', AgaviPressConfig::get('i18n.languages.code'));
		$names = explode(',', AgaviPressConfig::get('i18n.languages.name'));
		return array_combine($codes, $names);
	}
}
