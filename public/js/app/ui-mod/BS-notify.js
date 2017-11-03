/*
    |--------------------------------------------------------------------------
    |  Notification Module
    |--------------------------------------------------------------------------
    |
    | This module is used for conveniently generate bootstrap notifications on 
    | the platform.
    |
    */
define(['jquery','bootstrap-notify'], ($) => { 
	
	/**
	 * Module to generate bootstrap notifications
	 * @param  {Object} options Notifications parameters
	 * @property {String} options.icon Material icon on the notification
	 * @property {String} options.message Content of the notification
	 * @property {String} options.style Bootstrap-style color of the notification
	 * @property {Number} options.timer Time on screen in milliseconds
	 * @property {String} options.from Vertical alignment of the notification
	 * @property {String} options.align Horizontal alignment of the notification
	 * @return {Void}         
	 */
	return (options) => {
		$.notify({
			icon: options.icon || 'notifications',
			message: options.message || '...',
		}, {
			type: options.style || 'info',
			timer: options.timer || 4000,
			placement: {
				from: options.align || 'top',
				align: options.side || 'right',
			},
		})
	}
})
