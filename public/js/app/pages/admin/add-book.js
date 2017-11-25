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
		'app/ui-mod/BS-Notify',
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
			if(!response) return

			const formData = new FormData(e.target)
			formData.append('image', response.image)
			formData.append('authors', response.authors)
			formData.append('title', response.title)
			formData.append('publisher', response.publisher)

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

		$.ajax(`https://www.googleapis.com/books/v1/volumes?q=isbn:${e.target.value}&${appConfig.google.key}`)
		.then(res => {
			if(res.totalItems > 0) {
				const book = res.items[0].volumeInfo
				const info = [
					`<p>Publisher: ${book.publisher} on ${book.publishedDate}</p>`,
					`<p>Author${book.authors.length > 1 ? 's' : ''}: ${book.authors.join(', ')}</p>`,
				].join('')

				bookDetailsContainer.find('h4').text(`${book.title} ${book.subtitle}`)
				bookDetailsContainer.find('p').html(info)

				if(bookDetailsContainer.find('img')[0]) {
					bookDetailsContainer.find('img').attr('src', book.imageLinks.thumbnail)
				}else {
					bookDetailsContainer.find('h4')
						.before(`<img src="${book.imageLinks.thumbnail}" style="width: auto">`)
				}
			}else {
				bookDetailsContainer.find('h4').text('Book details could not be found')
				bookDetailsContainer.find('img').remove()
				bookDetailsContainer.find('p').text('')
			}
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
