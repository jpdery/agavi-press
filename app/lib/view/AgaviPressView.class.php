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
 * The view from which all project views inherit.
 *
 * A view represents the presentation layer of an action. Output can be
 * customized by supplying attributes, which a template can manipulate and
 * display.
 *
 * @package    agavi-press
 * @subpackage view
 *
 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
 * @copyright  Authors
 * @copyright  The AgaviPress Project
 *
 * @since      0.1.0
 *
 * @version    0.1.0
 */
class AgaviPressView extends AgaviView
{
	const SLOT_LAYOUT_NAME = 'slot';

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
	 * Initialize this view.
	 *
	 * @param      AgaviExecutionContainer This View's execution container.
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

	/**
	 * Handles output types that are not handled elsewhere in the view. The
	 * default behavior is to simply throw an exception.
	 *
	 * @param      AgaviRequestDataHolder The request data associated with
	 *                                    this execution.
	 *
	 * @throws     AgaviViewException if the output type is not handled.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	public final function execute(AgaviRequestDataHolder $rd)
	{
		throw new AgaviViewException(sprintf(
			'The view "%1$s" does not implement an "execute%3$s()" method to serve '.
			'the output type "%2$s", and the base view "%4$s" does not implement an '.
			'"execute%3$s()" method to handle this situation.',
			get_class($this),
			$this->container->getOutputType()->getName(),
			ucfirst(strtolower($this->container->getOutputType()->getName())),
			get_class()
		));
	}

	/**
	 * Prepares the HTML output type.
	 *
	 * @param      AgaviRequestDataHolder The request data associated with
	 *                                    this execution.
	 * @param      string The layout to load.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	public function setupHtml(AgaviRequestDataHolder $rd, $layoutName = null)
	{
		if ($layoutName === null && $this->getContainer()->getParameter('is_slot', false)) {
			// it is a slot, so we do not load the default layout, but a different one
			// otherwise, we could end up with an infinite loop
			$layoutName = self::SLOT_LAYOUT_NAME;
		}

		// now load the layout
		// this method returns an array containing the parameters that were declared on the layout (not on a layer!) in output_types.xml
		// you could use this, for instance, to automatically set a bunch of CSS or Javascript includes based on layout parameters -->
		$this->loadLayout($layoutName);
	}

    /**
     * Create a slot inside a layer.
     *
     * @param      string The layer name.
     * @param      string The slot name.
     * @param      string The module used for the slot.
     * @param      string The action used for the slot.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	public function setSlot($layer, $slot, $module, $action, $arguments = null, $outputType = 'html', $method = 'read')
	{
		$s = $this->createSlotContainer($module, $action, $arguments, 'html', $method);
		$l = $this->getLayer($layer);
		$l->setSlot($slot, $s);
	}

    /**
     * Set pre-populated values inside a form. If no form id are specified, the
	 * current form will be used.
	 *
	 * @param      AgaviParameterHolder The population parameters.
	 *
	 * @param      string The form identifier.
	 * @param      string The request method to act upon.
	 *
	 * @return     bool Whether or not the form has been populated.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	protected function populateForm(AgaviParameterHolder $parameters, $form, $method = 'read')
	{
		if ($method) {
			// prevent the form to be populated on a different request method
			if ($this->container->getRequestMethod() != $method) {
				return false;
			}
		}

		$this->request->setAttribute('populate', array($form => $parameters), 'org.agavi.filter.FormPopulationFilter');

		return true;
	}

    /**
     * Populate a form using all the values of an array.
     *
	 * @param      array The population parameters.
	 * @param      string The form identifier.
	 * @param      string The request method to act upon.
	 *
	 * @return     bool Whether or not the form has been populated.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	protected function populateFormFields(array $fields, $form = null, $method = 'read')
	{
		if ($method) {
			// prevent the form to be populated on a different request method
			if ($this->container->getRequestMethod() != $method) {
				return false;
			}
		}

		$this->getFormPopulation($form)->setParameters($fields);

		return true;
	}

    /**
     * Populate a single form field.
     *
	 * @param      string The field name.
	 * @param      string The field value.
	 * @param      string The form identifier.
	 * @param      string The request method to act upon.
	 *
	 * @return     bool Whether or not the form has been populated.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	protected function populateFormField($field, $value, $form = null, $method = 'read')
	{
		if ($method) {
			// prevent the form to be populated on a different request method
			if ($this->container->getRequestMethod() != $method) {
				return false;
			}
		}

		$this->getFormPopulation($form)->setParameter($field, $value);

		return true;
	}

	/**
	 * Return a reference of the data that will be used to populate a form. A new
	 * parameter holder will be created automatically if the form has not been
	 * yet associated with any data.
	 *
	 * @param      string The optional form identifier.
	 *
	 * @return     AgaviParameterHolder The population parameters.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	protected function getFormPopulation($form = null)
	{
		$data = $this->request->getAttribute('populate', 'org.agavi.filter.FormPopulationFilter');

		if ($form == null) {
			$data = $data ? $data : new AgaviParameterHolder();
		} else {
			if ($data) {
				if (array_key_exists($form, $data) == false) $data[$form] = new AgaviParameterHolder();
			} else {
				$data = array($form => new AgaviParameterHolder());
			}
		}

		$this->request->setAttributeByRef('populate', $data, 'org.agavi.filter.FormPopulationFilter');

		return $form ? $data[$form] : $data;
	}

    /**
     * Return the title.
     *
     * @return     string The title of this view.
     *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	public function getTitle()
	{
		return '';
	}

    /**
     * Return the description.
     *
     * @return     string The description of this view.
     *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	public function getDescription()
	{
		return '';
	}
}

?>