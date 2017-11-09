/*
    |--------------------------------------------------------------------------
    | Datatable Module
    |--------------------------------------------------------------------------
    |
    | This module is used for quickly initializing datatables on the admin 
    | panel. 
    |
    */
define(['jquery','jquery.DataTables.min','dataTables.bootstrap4.min'], ($) => {
	'use strict'

	return (option) => {
		const module = {
			options: {
				selectors: option || [],
			},
		}

		/**
		 * Initialize module
		 * @return {Void} 
		 */
		module.init = () => {
			initTables()
		}

		/**
		 * Initialize the jQuery data tables
		 * @return {Void} 
		 */
		function initTables() {
			module.options.selectors.forEach(selector => $(selector).DataTable())
		}

		module.init()
	}
})