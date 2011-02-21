/*
---

name: UI.Translatable.Transition.Scroll

description: Create a scrolling transition between each translatable fields.

license: MIT-style license.

requires:
	- Core/Class
	- Core/Class.Extras
	- UI.Translatable.Transition

provides:
	- UI.Translatable.Transition.Scroll

...
*/

/**
 * Create a scrolling transition between each translatable fields.
 *
 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
 * @version    0.1.0
 */
UI.Translatable.Transition.Scroll = new Class({

	/**
	 * @var        Fx.Scroll The scroller.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	labelScroller: null,

	inputScroller: null,

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

