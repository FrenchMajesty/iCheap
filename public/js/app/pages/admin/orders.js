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
				orders: {
					status: {
						received: null,
						completed: null,
					},
					data: null,
				}
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
			const order = module.options.orders.data.reduce(order => order.id == row.data('id'))

			GoogleLibrary(order.book.isbn, (book) => {
				if(book) {
					const row = $(e.target).parents('tr')
					const info = [
						`<p>Author${book.authors.length > 1 ? 's' : ''}: ${book.authors.join(', ')}</p>`,
						`<p>Publisher: ${book.publisher}</p>`,
						`<p>Price Given: <b>$${order.book.price}</b></p>`,
						order.payment_amount ? `<p>Price Paid: <b>$${order.payment_amount}</b></p>`: '',
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
		 * Submit AJAX Request to mark an order as received or completed
		 * @param  {Event} e Click Event
		 * @return {Void}   
		 */
		function updateOrderStatus(e) {
			e.stopPropagation()

			if($(e.target).attr('disabled')) {
				return
			}

			const row = $(e.target).parents('tr')
			const status = $(e.target).attr('data-action') == 'received'
							? module.options.orders.status.received
							: module.options.orders.status.completed

			const formData = new FormData()
			formData.append('id', row.data('id'))
			formData.append('status', status)

			FormHandler.submitRequest(module.options.url.edit, formData)
				.then(_ => swal('Success!','The order status was successfully updated.','success'))
				.fail(_ => swal('Oops!','An error occured was updating the status of this order.','error'))
		}

		/**
		 * Bind events to page DOM
		 * @return {Void} 
		 */
		function bindUIEvents() {
			$(document).on('click','[data-action="book"]', showBookDetails)
			$(document).on('click','[data-action="received"]', updateOrderStatus)
			$(document).on('click','[data-action="completed"]', updateOrderStatus)
		}	

		module.init()
	}
})
