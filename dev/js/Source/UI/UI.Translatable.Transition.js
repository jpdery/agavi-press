/*
---

name: UI.Translatable.Transition

description: Provide the base class for a transition between translatable
             fields.

license: MIT-style license.

requires:
	- Core/Class
	- Core/Class.Extras

provides:
	- UI.Translatable.Transition

...
*/

if (!window.UI) window.UI = {};
if (!window.UI.Translatable) window.UI.Translatable = {};

/**
 * Provide the base class for a transition between translatable fields.
 *
 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
 * @version    0.1.0
 */
UI.Translatable.Transition = new Class({

	/**
	 * @var        UI.Translatable The translatable element.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	translatable: null,

	/**
	 * Initialize the transition.
	 *
	 * @param      UI.Translatable The translatable element.
	 *
	 * @return     UI.Translatable.Transition The current instance.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	initialize: function(translatable) {
		this.translatable = translatable;
		return this;
	},

	/**
	 * Start the transition.
	 *
	 * @param      Element The element to transition to.
	 *
	 * @return     UI.Translatable.Transition The current instance.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	startLabelTransition: function(element, container) {
		if (this.labelScroller == null) {
			this.labelScroller = new Fx.Scroll(container);
		}
		this.labelScroller.toElement(element);
		return this;
	},

	startInputTransition: function(element, container) {
		if (this.inputScroller == null) {
			this.inputScroller = new Fx.Scroll(container);
		}
		this.inputScroller.toElement(element);
		return this;
	}

});

