/*
|--------------------------------------------------------------------------
|  Locator Module
|--------------------------------------------------------------------------
|
| This module is for the Google Geocoder and is used to locate users and find
| address coordinates.
|
*/
define(['jquery','app/handler/form','config'], ($, handler, appConfig) => { 
	const FormHandler = handler()
	const module = {
		options: {
			geocoder: null,
		},
	}

	/**
	 * Initialize module
	 * @return {Void} 
	 */
	module.init = () => {
		module.options.geocoder = new google.maps.Geocoder()
	}

	/**
	 * Get the geolocation of the user
	 * @return {Google.Maps.Circle} Location point
	 */
	module.userPosition = () => {
		return new Promise((resolve, reject) => {
			if (navigator.geolocation) {
	        	navigator.geolocation.getCurrentPosition((position) => {
		            const geolocation = {
		              lat: position.coords.latitude,
		              lng: position.coords.longitude
		            }

		            const circle = new google.maps.Circle({
		              center: geolocation,
		              radius: position.coords.accuracy
		            })

		            resolve(circle)
	          	})
	    	}else {
	    		reject()
	    	}
    	})
	}

	/**
	 * Get geocoder information on an address
	 * @param  {String} address Address to search
	 * @return {Promise}         API's reponse
	 */
	module.findLocation = (address) => {
		return new Promise((resolve, reject) => {
			if (!module.options.geocoder) reject('No geocoder')

		   	module.options.geocoder.geocode({address: address, region: 'US'}, (results, status) => {
		    	if (status == google.maps.GeocoderStatus.OK) {
		        	if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {     
						resolve(results)
			        } else {
			        	reject("No results found")
			        }
		        } else {
		          reject("Geocode was not successful for the following reason: " + status)
		        }
		    })
		})
	}

	/**
     * Initialize an address field for autocomplete with Google Maps API
     * @param  {HTMLElement} input Input field
     * @return {Void}       
     */
    module.initAddressField = (input) => {
        const autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(input), {types: ['geocode']})

        $(input).on('focus',() => {
            module.userPosition()
            .then(position => autocomplete.setBounds(position.getBounds()))
        })
    }

	if(typeof google !== 'undefined') {
 		module.init()
 	}

	return module
})
