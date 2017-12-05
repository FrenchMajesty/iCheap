/*
|--------------------------------------------------------------------------
|  Sell Book Module
|--------------------------------------------------------------------------
|
| This module is used on the page to generate a shipping label for users 
| trying to sell their textbooks.
|
*/
define(['jquery'], ($) => { 
	
	return (option) => {
		const module = {
			options: $.extend(true, {
				pageRefreshDelay: 7000,
			},option),
		}
		
		/**
	 * Initialize module
	 * @return {Void} 
	 */
	 module.init = () => {
	 	bindUIEVents()
	 }


	 /**
	  * Refresh the page after a waiting an arbitrary amount of seconds to
	  * make sure the Shipping Label had time to be generated
	  */
	 function RefreshPageAfterDelay() {
	 	setTimeout(() => {
	 		window.location.reload(true)
	 	}, module.options.pageRefreshDelay)
	 }	

	/**
	 * Bind events to page DOM
	 * @return {Void} 
	 */
	 function bindUIEVents() {
	 	$('#label').on('click', RefreshPageAfterDelay)
	 }

	 module.init()
	}
})
