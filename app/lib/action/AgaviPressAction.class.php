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
 * The action from which all project actions inherit.
 *
 * AgaviAction allows you to separate application and business logic from your
 * presentation. By providing a core set of methods used by the framework,
 * automation in the form of security and validation can occur.
 *
 * @package    agavi-press
 * @subpackage action
 *
 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
 * @copyright  Authors
 * @copyright  The AgaviPress Project
 *
 * @since      0.1.0
 *
 * @version    0.1.0
 */
class AgaviPressAction extends AgaviAction
{
	/**
	 * @var        AgaviPressRouting
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>	 
	 */
	protected $routing = null;
	
	/**
	 * @var        AgaviRequest
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 */
	protected $request = null;
	
	/**
	 * @var        AgaviPressTranslationManager
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>	 
	 */
	protected $translationManager = null;
	
	/**
	 * @var        AgaviUser
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 */
	protected $user = null;
	
	/**
	 * @var        string The default 2 letters code language.
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 */
	protected $defaultLanguage = '';
	
	/**
	 * @var        string The current 2 letters code language.
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 */
	protected $currentLanguage = '';	
	
	/**
	 * Initialize this action.
	 *
	 * @param      AgaviExecutionContainer This Action's execution container.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	public function initialize(AgaviExecutionContainer $container)
	{
		parent::initialize($container);
		
		$this->user = $this->context->getUser();
		$this->routing = $this->context->getRouting();
		$this->request = $this->context->getRequest();
		$this->translationManager = $this->context->getTranslationManager();
						
		// set the default and current language
		$this->defaultLanguage = $this->translationManager->getDefaultLocale()->getLocaleLanguage();
		$this->currentLanguage = $this->translationManager->getCurrentLocale()->getLocaleLanguage();		
	}
}

?>