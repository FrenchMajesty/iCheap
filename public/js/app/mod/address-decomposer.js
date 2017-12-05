/*
|--------------------------------------------------------------------------
|  Address Decomposer Module
|--------------------------------------------------------------------------
|
| This module is used for the address input and setting its components.
|
*/
define(['jquery','app/api/google/locator'], ($, Locator) => { 
	
	return (option) => {
		const module = {
			options: $.extend(true, {
				selector: '#address',
			},option),
		}
		
		/**
		 * Initialize the module
		 * @return {Void} 
		 */
		 module.init = () => {
			// Init autocomplete address
			const addressField = $(module.options.selector)
			Locator.initAddressField(addressField[0])

			bindUIEvents()
		}

		/**
		 * Fetch the address coordinates and components
		 * @param {Event} e Blur event
		 */
		 function getAddressComponents(e) {
		 	Locator.findLocation(e.target.value)
		 	.then(res => {
		 		const address = {}

		 		res[0].address_components.forEach(component => {	
		 			if(component.types[0] == 'street_number') {
		 				address.street_number = component.short_name
		 			}else if(component.types[0] == 'route') {
		 				address.street = component.short_name
		 			}else if(component.types[0] == 'subpremise') {
		 				address.apt = component.short_name
		 			}else if(component.types[0] == 'locality') {
		 				address.city = component.short_name
		 			}else if(component.types[0] == 'administrative_area_level_1') {
		 				address.state = component.short_name
		 			}else if(component.types[0] == 'country') {
		 				address.country = component.short_name
		 			}else if(component.types[0] == 'postal_code') {
		 				address.zip = component.short_name
		 			}else {
		 				address.extra 
		 				? address.extra += ' '+component.short_name
		 				: address.extra = ''
		 			}
		 		})

		 		setAddressComponents(address)
		 	})
		 }

		/**
		 * Set the corresponding input's value to the address component
		 * @param {Object} address Address's components
		 */
		 function setAddressComponents(address) {
		 	const extra = address.extra ? address.extra : ''

		 	$('input[name="address_1"]').val(address.street_number+' '+address.street)
		 	$('input[name="address_2"]').val(address.apt ? `Apt. ${address.apt} ${extra}` : extra)
		 	$('input[name="city"]').val(address.city)
		 	$('input[name="zip"]').val(address.zip)
		 	$('input[name="state"]').val(address.state)
		 	$('input[name="country"]').val(address.country)
		 }

		/**
		 * Bind events to the page DOM
		 * @return {Void} 
		 */
		 function bindUIEvents() {
		 	$(module.options.selector).on('blur', getAddressComponents)
		 }

		module.init()
	}
})
