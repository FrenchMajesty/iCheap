define(['jquery','app/mod/address-decomposer'], ($, Decomposer) => { 
	const module = {}

	/**
	 * Initialize the module
	 * @return {Void} 
	 */
	module.init = () => {
		// Activate address search decomposer
		Decomposer({
			selector: '#address',
			onResponse: activateRegisterButton
		})
		 
		bindUIEvents()
	}

	/**
	 * Activate the button to submit the registration form
	 * @return {Void} 
	 */
	function activateRegisterButton() {
		$('#register-button').removeAttr('disabled').removeClass('disabled')
	}

	/**
	 * Disable the button to submit the registration form
	 * @return {Void} 
	 */
	function disableRegisterButton() {
		$('#register-button').attr('disabled','disabled').addClass('disabled')
	}

	/**
	 * Bind events to the page DOM
	 * @return {Void} 
	 */
	function bindUIEvents() {
		$('#address').on('keydown', disableRegisterButton)
	}

	module.init()
})
