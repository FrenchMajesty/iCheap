/*
    |--------------------------------------------------------------------------
    |  Add Book Module
    |--------------------------------------------------------------------------
    |
    | This module is for the JavaScript on the page to add a desired book.
    |
    */
define(['jquery',
		'app/handler/form',
		'app/ui-mod/BS-notify',
		'app/api/google-library',
		'config',
], ($, handler, BSNotify, GoogleLibrary, appConfig) => { 
	
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
		e.preventDefault()

		const isbn = $(e.target).find('input[name="isbn"]').val()
		GoogleLibrary(isbn, (response) => {
			if(!response) {
				BSNotify({
					style: 'danger',
					icon: 'error',
					message: 'An error occured while trying to find and download your book\'s info.',
				})

				return
			}

			const formData = new FormData(e.target)
			formData.append('image', response.image)
			formData.append('authors', response.authors)
			formData.append('title', response.title)
			formData.append('publisher', response.publisher)
			formData.append('description', response.description)
			formData.append('height', response.dimensions.height)
			formData.append('width', response.dimensions.width)
			formData.append('thickness', response.dimensions.thickness)

			FormHandler.submitRequest('', formData)
			.then(_ => {
				e.target.reset()
				BSNotify({
					style: 'success',
					icon: 'check',
					message: 'Your book was successfully created!',
				})
			})
			.fail(res => FormHandler.displayErrors(e.target, res.responseJSON.errors))
		})
	}

	/**
	 * Fetch the book details from Google Library API and display on page
	 * @param  {Event} e Blur event
	 * @return {Void}   
	 */
	function loadBookDetails(e) {
		if(!e.target.value) return

		const bookDetailsContainer = $('#book')

		GoogleLibrary(e.target.value, (book) => {

			if(book) {
			const info = [
					`<p>Publisher:${book.publisher}</p>`,
					`<p>Author${book.authors.length > 1 ? 's' : ''}: ${book.authors.join(', ')}</p>`,
				].join('')

				bookDetailsContainer.find('h4').text(book.title)
				bookDetailsContainer.find('p').html(info)

				if(bookDetailsContainer.find('img')[0]) {
					bookDetailsContainer.find('img').attr('src', book.image)
				}else {
					bookDetailsContainer.find('h4')
						.before(`<img src="${book.image}" style="width: 80%">`)
				}

				return
			}

			bookDetailsContainer.find('h4').text('Book details could not be found')
			bookDetailsContainer.find('img').remove()
			bookDetailsContainer.find('p').text('')
		})
	} 

	/**
	 * Bind events to page DOM
	 * @return {Void} 
	 */
	function bindUIEvents() {
		$('form').on('submit', handleCreateBook)
		$('[name="isbn"]').on('blur', loadBookDetails)
		$('form input').on('input keydown change', FormHandler.clearErrors)
	}

	module.init()
})
