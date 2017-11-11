/*
    |--------------------------------------------------------------------------
    |  Orders Module
    |--------------------------------------------------------------------------
    |
    | This module is the JavaScript used in the Orders manager page. It handles
    | form submission for status change and modal handling for book details.
    |
    */
define(['jquery',
		'app/handler/form',
		'app/handler/template',
		'app/ui-mod/datatable',
		'app/api/google-library',
		'sweetalert',
	], ($, handler, Templator, DataTables, GoogleLibrary, swal) => { 
	
	const FormHandler = handler()
	return (option) => {
		const module = {
			options: $.extend(true, {
				url: {
					received: null,
					completed: null,
				},
				orders: null,
			},option),
		}
			
		/**
		 * Initialize module
		 * @return {Void} 
		 */
		module.init = () => {
			// Initialize DataTables
			DataTables(['.table'])
			bindUIEvents()
		}

		/**
		 * Open a modal to show additional informations about a book
		 * @param  {Event} e Click Event
		 * @return {Void}   
		 */
		function showBookDetails(e) {
			const row = $(e.target).parents('tr')
			const order = module.options.orders.reduce(order => order.id == row.data('id'))

			GoogleLibrary(order.book.isbn, (book) => {
				if(book) {
					const row = $(e.target).parents('tr')
					const info = [
						`<p>Author${book.authors.length > 1 ? 's' : ''}: ${book.authors.join(', ')}</p>`,
						`<p>Publisher: ${book.publisher}</p>`,
						`<p>Price Given: <b>$${order.book.price}</b></p>`,
					].join('')
					const template = Templator('order-book-details')
					const html = template({image: book.image, title: book.title, additional: info})

					swal({
						type: 'info',
						title: 'Book and Order\'s Details',
						html: html,
						confirmButtonText: 'Close',
					})
				}else {
					swal('Error','There was an error loading this book\'s details.','error')
				}
			})
		}

		/**
		 * Bind events to page DOM
		 * @return {Void} 
		 */
		function bindUIEvents() {
			$(document).on('click','[data-action="book"]', showBookDetails)
		}

		module.init()
	}
})
