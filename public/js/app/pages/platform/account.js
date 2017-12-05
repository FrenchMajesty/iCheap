/*
|--------------------------------------------------------------------------
|  Account Module
|--------------------------------------------------------------------------
|
| This module is for the user's account page where they can update their
| account informations, passwords, and see past and current orders.
|
*/
define(['jquery','app/api/google/locator'], ($, Locator) => { 
	
	return (option) => {
		const module = {
			options: $.extend(true, {
				passwordWasSubmitted: false,
			},option),
		}

		/**
		 * Initialize module
		 * @return {Void} 
		 */
		module.init = () => {
			if(module.options.passwordWasSubmitted) {
				scrollToPasswordContainer()
			}
			const input = $('#address')[0]
			Locator.initAddressField(input)
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
		 * Scroll the page down to the container to update the user's password
		 * @return {Void} 
		 */
		function scrollToPasswordContainer() {
	        $('html, body').animate({ scrollTop: $('#login-form-wrap').offset().top }, 1000)
		}

		/**
		 * Bind events to the page DOM
		 * @return {Void} 
		 */
		function bindUIEvents() {
			$('#search input').on('keyup', updateOrdersDisplayed)
		}
			
		module.init()
	}
})
