/*
---

name: UI.Translatable

description: Provide a way to navigate through each translation of field.

license: MIT-style license.

requires:
	- Core/Class
	- Core/Class.Extras
	- More/Class.Binds
	- Extras/UI.Control
	- UI.Translatable.Transition.Scroll

provides:
	- UI.Translatable

...
*/

/**
 * Provide a way to navigate through each translation of field.
 *
 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
 * @version    0.1.0
 */
UI.Translatable = new Class({

	Extends: UI.Control,

	Binds: ['onLabelClick', 'onLabelMouseEnter', 'onLabelMouseLeave'],

	/**
	 * @var        Elements The label elements for language identification.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	labels: null,

	/**
	 * @var        Elements The translation input elements.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	inputs: null,

	/**
	 * @var        UI.Translatable.Transition The transition object.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	transition: null,

	/**
	 * @var        string The current language.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	language: null,

	/**
	 * @var        object The class options.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	options: {
		transition: UI.Translatable.Transition.Scroll,
		labelSelector: '.translatable-labels',
		inputSelector: '.translatable-inputs',
		labelsSelector: '.translatable-labels .translatable-label',
		inputsSelector: '.translatable-inputs .translatable-input'
	},

	/**
	 * Initialize the control by providing its element.
	 *
	 * @param      mixed The control's element which can be a string, an element or an object.
	 * @param      object The control's options.
	 *
	 * @return     UI.Translatable A reference of this instance.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	initialize: function(element, options) {
		this.setElement(element);
		this.setOptions(options);
		this.label = this.element.getElement(this.options.labelSelector);
		this.input = this.element.getElement(this.options.inputSelector);
		this.labels = this.element.getElements(this.options.labelsSelector);
		this.inputs = this.element.getElements(this.options.inputsSelector);
		this.parent(element, options);
		return this;
	},

	/**
	 * Attach the required control's events.
	 *
	 * @return     UI.Translatable The current instance.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	attachEvents: function() {
		this.labels.addEvent('click', this.onLabelClick);
		this.label.addEvent('mouseenter', this.onLabelMouseEnter);
		this.label.addEvent('mouseleave', this.onLabelMouseLeave);
		return this;
	},

	/**
	 * Detach the required control's events.
	 *
	 * @return     UI.Translatable The current instance.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	detachEvents: function() {
		this.labels.removeEvent('click', this.onLabelClick);
		this.label.removeEvent('mouseenter', this.onLabelMouseEnter);
		this.label.removeEvent('mouseleave', this.onLabelMouseLeave);
		return this;
	},

	/**
	 * Select a translation.
	 *
	 * @param      string The language.
	 *
	 * @return     UI.Translatable The current instance.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	pick: function(language) {

		this.language = language;

		if (this.transition == null) {
			this.transition = new this.options.transition(this);
		}

		var label = this.labels.filter('[data-language=' + language + ']').pop();
		var input = this.inputs.filter('[data-language=' + language + ']').pop();

		if (label && input) {
			this.transition.startLabelTransition(label, label.getParent(this.options.labelsSelector));
			this.transition.startInputTransition(input, input.getParent(this.options.inputsSelector));
		}

		return this;
	},

	/**
	 * Select a translation.
	 *
	 * @param      string The language.
	 *
	 * @return     UI.Translatable The current instance.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	onLabelClick: function(e) {
		var language = e.target.getNext().getProperty('data-language');
		if (language) {
			this.pick(language);
		}
	},

	onLabelMouseEnter: function(e) {
		this.label.addClass('expand');
	},

	onLabelMouseLeave: function(e) {
		this.label.removeClass('expand');
	}

});