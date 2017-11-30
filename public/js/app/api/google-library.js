/*
|--------------------------------------------------------------------------
|  Google Library Module
|--------------------------------------------------------------------------
|
| This module is used for fetching books data from the Google Library API
|
*/
define(['jquery','config'], ($, appConfig) => { 

	return (option, ModuleCallback) => {
		const module = {
			options: {
				isbn: option || null,
			}
		}

	/**
	 * Initialize module
	 * @return {Void} 
	 */
	 module.init = () => {
	 	loadBookData()
	 }

	/**
	 * Fetch the book's ID from Google Library API
	 * @return {Promise} Request Response
	 */
	 function loadBookID() {
	 	return new Promise((resolve, reject) => {
	 		$.ajax(`https://www.googleapis.com/books/v1/volumes?q=isbn:${module.options.isbn}&${appConfig.google.key}`)
	 		.then(res => {
	 			if(res.totalItems > 0) {
	 				resolve(res.items[0].id)
	 			} else {
	 				reject(null)
	 			}
	 		})
	 		.catch(_ => reject(null))
	 	})
	 }

	/**
	 * Fetch the book's data from Google Library API and pass it to the module' callback
	 * @callback ModuleCallback
	 * @return {Void} 
	 */
	 function loadBookData() {
	 	loadBookID()
	 	.then(bookID => {
	 		$.ajax(`https://www.googleapis.com/books/v1/volumes/${bookID}`)
	 		.then(res => {
	 			if(res) {
	 				const data = res.volumeInfo
	 				const dim = data.dimensions
	 				const book = {
	 					authors: data.authors,
	 					publisher: `${data.publisher} on ${data.publishedDate}`,
	 					title: `${data.title} ${data.subtitle}`,
	 					image: data.imageLinks.medium,
	 					dimensions: {
	 						height: dim.height.match(/[\d\.]+/)[0],
	 						width: dim.width.match(/[\d\.]+/)[0],
	 						thickness: dim.thickness ? dim.thickness.match(/[\d\.]+/)[0] : '',
	 					},
	 				}

	 				ModuleCallback(book)
	 			}else {
	 				ModuleCallback(null)
	 			}
	 		})
	 		.fail(_ => ModuleCallback(null))
	 	})


	 }

	 module.init()
	}
})
