/*
    |--------------------------------------------------------------------------
    |  Add Book Module
    |--------------------------------------------------------------------------
    |
    | This module is for the JavaScript on the page to add a desired book.
    |
    */
define(['jquery','app/handler/form','app/ui-mod/BS-Notify'], ($, handler, BSNotify) => { 
	
	const FormHandler = handler()

	const module = {}
		
	/**
	 * Initialize module
	 * @return {Void} 
	 */
	module.init = () => {
		bindUIEvents()
	}

	/**
	 * Submit an AJAX request to the server to create a book
	 * @param  {Event} e Submit event
	 * @return {Void}   
	 */
	function handleCreateBook(e) {
		FormHandler.handleSubmit(e)
		.then(_ => {
			e.target.reset()
			BSNotify({
				style: 'success',
				icon: 'check',
				message: 'Your book was successfully created!',
			})
		})
		.fail(res => FormHandler.displayErrors(e.target, res.responseJSON.errors))
	} 

	/**
	 * Bind events to page DOM
	 * @return {Void} 
	 */
	function bindUIEvents() {
		$('form').on('submit', handleCreateBook)
		$('form input').on('input keydown change', FormHandler.clearErrors)
	}

	module.init()
})
