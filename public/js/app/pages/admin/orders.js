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
		'sweetalert',
	], ($, handler, Templator, DataTables, swal) => { 
	
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
			const order = module.options.orders.data.filter(order => order.id == row.data('id'))[0]

			const info = [
				`<p>Author${order.book.authors.length > 1 ? 's' : ''}: ${order.book.authors}</p>`,
				`<p>Publisher: ${order.book.publisher}</p>`,
				`<p>Price Given: <b>$${order.book.price}</b></p>`,
				order.payment_amount ? `<p>Price Paid: <b>$${order.payment_amount}</b></p>`: '',
			].join('')
			const template = Templator('order-book-details')
			const html = template({image: order.book.image, title: order.book.title, additional: info})

			swal({
				type: 'info',
				title: 'Book and Order\'s Details',
				html: html,
				confirmButtonText: 'Close',
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

			FormHandler.submitRequest(module.options.url.received, formData)
				.then(_ => swal('Success!','The order status was successfully updated.','success'))
				.fail(_ => swal('Oops!','An error occured was updating the status of this order.','error'))
		}

		/**
		 * Open the modal to complete an order as fulfilled
		 * @param  {Event} e Click event
		 * @return {Void}   
		 */
		function fulfillOrder(e) {
			e.stopPropagation()

			if($(e.target).attr('disabled')) return
			
			const row = $(e.target).parents('tr')
			const status = $(e.target).attr('data-action') == 'received'
							? module.options.orders.status.received
							: module.options.orders.status.completed

			const template = Templator('order-fulfill')
			const html = template({
				id: row.data('id'),
				status: status,
				price: '',
			})

			swal({
				title: 'Complete the Order',
				html: html,
				preConfirm: handleFulfillOrderModalSubmit,
				showLoaderOnConfirm: true,
				showCancelButton: true,
				allowOutsideClick: false,
			}).then(() => {
				swal('Success!','The order status was successfully updated.','success')
			}, (dismiss) => {
				if(dismiss != 'cancel') {
					swal('Oops!','An error occured was updating the status of this order.','error')
				}
			})	
		}

		/**
		 * Submit an AJAX Request to update the status of an order
		 * @return {Promise} Server response
		 */
		function handleFulfillOrderModalSubmit() {
			return new Promise((resolve, reject) => {
				const form = $('#order-fulfill')
				const formData = new FormData(form[0])

				FormHandler.submitRequest(form.attr('action'), formData)
				.then(_ => resolve())
				.fail(res => {
					if(res.responseJSON.errors) {
						const errors = Object.keys(res.responseJSON.errors).map(field => {
							return res.responseJSON.errors[field][0]
						})

						reject(errors)
					} else {
						reject('An error occured while fulfilling this order. It may already be fulfilled, please refresh the page.')
					}
				})
			})
		}

		/**
		 * Bind events to page DOM
		 * @return {Void} 
		 */
		function bindUIEvents() {
			$(document).on('click','[data-action="book"]', showBookDetails)
			$(document).on('click','[data-action="received"]', updateOrderStatus)
			$(document).on('click','[data-action="completed"]', fulfillOrder)
		}	

		module.init()
	}
})
