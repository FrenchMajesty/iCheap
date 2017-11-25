/*
    |--------------------------------------------------------------------------
    |  Books Module
    |--------------------------------------------------------------------------
    |
    | This module is for the books manager page on the admin panel. It handles
    | the form and modal for editing and deleting books.
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
					edit: null,
					delete: null,
				},
			},option),
		}
			
		/**
		 * Initialize module
		 * @return {Void} 
		 */
		module.init = () => {
			bindUIEvents()

			// Init Data Tables
			DataTables(['table'])				
		}

		/**
		 * Open and load a book's information into a modal for editing
		 * @param  {Event} e Click event
		 * @return {Void}   
		 */
		function openEditingModal(e) {
			const row = $(e.target).parents('tr')
			const price = row.find('[data-price]').data('price')
			const template = Templator('edit-book')
			const html = template({id: row.data('id'), price: price})

			swal({
			 	title: 'Update a Book',
				html: html,
			 	confirmButtonText: 'Save',
			 	showCancelButton: true,
			  	showLoaderOnConfirm: true,
			  	allowOutsideClick: false,
			  	preConfirm: handleUpdateBookModalSubmit,
			}).then(() => {
				swal('Success!','Your book was successfully updated.','success')
			}, (dismiss) => {})
		}

		/**
		 * Open modal to confirm the action before deleting the book
		 * @param  {Event} e Click event
		 * @return {Void}   
		 */
		function confirmDeleteModal(e) {
			const row = $(e.target).parents('tr')

			swal({
				title: 'Delete this Book',
				type: 'warning',
				text: 'Are you sure you want to do this? This action cannot be reverted.',
				showCancelButton: true,
				showLoaderOnConfirm: true,
				preConfirm: () => handleDeleteBookModalSubmit(row.data('id')),
			}).then(() => {
				swal('Success!','Your book was successfully deleted.','success')
			}, (dismiss) => {})
		}

		/**
		 * Handle the submit of an AJAX Request in the sweetAlert modal
		 * @return {Promise} Submit response
		 */
		function handleDeleteBookModalSubmit(bookID) {
			return new Promise((resolve, reject) => {
				const formData = new FormData()
				formData.append('id', bookID)

				FormHandler.loadAjaxSettings()
				$.ajax(`${module.options.url.delete}/${bookID}`, {
					type: 'DELETE',
					data: {
						_method: 'DELETE',
						id: bookID,
					}
				})
				.then(_ => resolve())
				.fail(res => {
					if(res.responseJSON.errors) {
						const errors = Object.keys(res.responseJSON.errors).map(field => {
							return res.responseJSON.errors[field][0]
						})

						reject(errors)
					} else {
						reject(['An error occured while deleting this book.',
								'It may no longer exist, please refresh the page.'].join(''))
					}
				})	
			})
		}

		/**
		 * Handle the submit of an AJAX Request in the sweetAlert modal
		 * @return {Promise} Submit response
		 */
		function handleUpdateBookModalSubmit() {
			return new Promise((resolve, reject) => {
				const form =  $('#edit-book')
				const formData = new FormData(form[0])

				FormHandler.submitRequest(form.attr('action'), formData)
					.then(_ => resolve())
					.fail(res => {
						const errors = Object.keys(res.responseJSON.errors).map(field => {
							return res.responseJSON.errors[field][0]
						})
						reject(errors)
					})
			})	
		}

		/**
		 * Bind events to page DOM
		 * @return {Void} 
		 */
		function bindUIEvents() {
			$(document).on('click', 'button[data-action="edit"]', openEditingModal)
			$(document).on('click', 'button[data-action="delete"]', confirmDeleteModal)
		}

		module.init()
	}
})
