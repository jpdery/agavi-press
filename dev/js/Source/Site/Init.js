/*
---

name: Init

description: Site-wide initialization using selectors.

license: MIT-style license.

requires:
	- Extras/Selector.Apply
	- Extras/Selector.Attach
	- UI.Translatable.js
	- UI.Translatable.Transition.js
	- UI.Translatable.Transition.Scroll.js

provides:
	- Init

...
*/

Selector.apply({

	'.translatable': function(el) {
		console.log('oui');
		new UI.Translatable(el);
	}
})

Selector.attach('.translatable', UI.Translatable);

