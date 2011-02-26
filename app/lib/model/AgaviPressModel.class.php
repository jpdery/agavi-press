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
 * The model from which all project models inherit.
 *
 * AgaviModel provides a convention for separating business logic from
 * application logic. When using a model you're providing a globally accessible
 * API for other modules to access, which will boost interoperability among
 * modules in your web application.
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
abstract class AgaviPressModel extends AgaviModel
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
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	protected $request = null;

	/**
	 * @var        AgaviPressTranslationManager
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	protected $translationManager = null;

	/**
	 * @var        AgaviUser
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	protected $user = null;

	/**
	 * @var        string The default 2 letters code language.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	protected $defaultLanguage = '';

	/**
	 * @var        string The current 2 letters code language.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	protected $currentLanguage = '';

	/**
	 * Initialize this model.
	 *
	 * @param      AgaviContext The current application context.
	 * @param      array Initialization parameters.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	public function initialize(AgaviContext $context, array $parameters = array())
	{
		parent::initialize($context, $parameters);

		$this->user = $this->context->getUser();
		$this->routing = $this->context->getRouting();
		$this->request = $this->context->getRequest();
		$this->translationManager = $this->context->getTranslationManager();

		// set the default and current language
		$this->defaultLanguage = $this->translationManager->getDefaultLocale()->getLocaleLanguage();
		$this->currentLanguage = $this->translationManager->getCurrentLocale()->getLocaleLanguage();
	}

	/**
	 * Pre-serialization callback.
	 *
	 * Will set the name of the context and exclude the instance from serializing.
	 *
	 * @author     David Zülke <dz@bitxtender.com>
	 * @author     Arran Walker <arran.walker@enixu.com>
	 * @since      0.1.0
	 */
	public function __sleep()
	{
		if ($this->context) {
			$this->_contextName = $this->context->getName();
			$arr = get_object_vars($this);
			unset($arr['context']);
			return array_keys($arr);
		}
		return array();
	}

	/**
	 * Post-unserialization callback.
	 *
	 * Will restore the context based on the names set by __sleep.
	 *
	 * @author     David Zülke <dz@bitxtender.com>
	 * @author     Arran Walker <arran.walker@enixu.com>
	 * @since      0.1.0
	 */
	public function __wakeup()
	{
		if (isset($this->_contextName)) {
			$this->context = AgaviContext::getInstance($this->_contextName);
			unset($this->_contextName);
		}
	}
}

?>