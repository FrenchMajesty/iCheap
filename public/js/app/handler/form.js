/*
    |--------------------------------------------------------------------------
    |  Form Handler Module
    |--------------------------------------------------------------------------
    |
    | This handler is used for all form operations performed on the platform 
    | like error handling and AJAX form submittion.
    |
    */
define(['jquery','config'], ($, appConfig) => {
    'use strict'

	return (config) => {
		const module = {
			config: $.extend({
                cloudinary: {
                    key: appConfig.cloudinary.key,
                    url: appConfig.cloudinary.url,
                },
                recaptcha: {
                    key: appConfig.recaptcha.key,
                },
			}, config),
		}

        /**
         * Set up ajax header with csrf token
         * @return {Void} 
         */
        module.loadAjaxSettings = () => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
        }

		/**
		 * Submit an AJAX form from an event
		 * @param  {Event} e Submit event
		 * @return {Promise}   Ajax Response
		 */
		module.handleSubmit = (e) => {
            e.preventDefault()

            const formData = new FormData(e.target)
            const url = e.target.getAttribute('action')

            module.loadAjaxSettings()
            return $.ajax(url, {
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
            })
		}

        /**
         * Submit an AJAX Form without processing
         * @param  {String} url      Submit target
         * @param  {FormData} formData Form data to submit
         * @return {Promise}          Ajax Response
         */
        module.submitRequest = (url, formData) => {
            module.loadAjaxSettings()
            return $.ajax(url, {
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
            })
        }

        /**
         * Submit an AJAX form to delete an element
         * @param  {String} url Submit url
         * @param  {Number} id  Item ID
         * @return {Promise}     Ajax response
         */
        module.handleDeleteRequest = (url, id) => {
            const formData = new FormData()
                  formData.append('id', id)

            module.loadAjaxSettings()
            return $.ajax(url, {
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
            })      
        }

        /**
         * Generate a Google Recaptcha
         * @param {String} target ID of the target div
         * @return {String} Widget ID
         */
        module.generateCaptcha = (target) => {
            return grecaptcha.render(target, { sitekey: module.config.recaptcha.key })
        }

        /**
         * Clear the errors of a form container
         * @param  {Event} Change event
         * @return {Void}
         */
         module.clearErrors = (e) => {
            const errorDiv = $(e.target).parents('form').find('section.error')
            errorDiv.removeClass('alert alert-danger').html('')
        }

        /**
         * Display the request errors in a form container
         * @param  {HTMLElement} elem  
         * @param  {JSON} errors
         * @return {Void} 
         */
        module.displayErrors = (elem, errors) => {
            if(!errors) return

            const errorDiv = $(elem).find('section.error')
            errorDiv.addClass('alert alert-danger').html('')

            let errorMessages = ''
            Object.keys(errors).forEach(err => {
                errors[err].forEach(err => errorMessages += `<li>${err}</li>`)
            })

            errorDiv.html(errorMessages)
        }

		return module
	}
})