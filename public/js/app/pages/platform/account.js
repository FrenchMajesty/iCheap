/*
    |--------------------------------------------------------------------------
    |  Account Module
    |--------------------------------------------------------------------------
    |
    | This module is for the user's account page where they can update their
    | account informations, passwords, and see past and current orders.
    |
    */
define(['jquery'], ($) => { 
	const module = {}

	/**
	 * Initialize module
	 * @return {Void} 
	 */
	module.init = () => {
		bindUIEvents()
	}	

	/**
	 * Update the orders displayed in the column based on the search
	 * @param  {Event} e Input event
	 * @return {Void}   
	 */
	function updateOrdersDisplayed(e) {
		const value = e.target.value
		const orders = $('[data-order]')

		orders.each((i, element) => {
			const el = $(element)

			if(!el.text().match(new RegExp(value, 'i'))) {
				el.hide()
			}else {
				el.show()
			}
		})
	}

	/**
	 * Bind events to the page DOM
	 * @return {Void} 
	 */
	function bindUIEvents() {
		$('#search input').on('keyup', updateOrdersDisplayed)
	}

	module.init()
})
