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
		 * Fetch the book's data from Google Library API and pass it to the module' callback
		 * @callback ModuleCallback
		 * @return {Void} 
		 */
		function loadBookData() {
			$.ajax(`https://www.googleapis.com/books/v1/volumes?q=isbn:${module.options.isbn}&${appConfig.google.key}`)
				.then(res => {
					if(res.totalItems > 0) {
						const data = res.items[0].volumeInfo
						const book = {
							authors: data.authors,
							publisher: `${data.publisher} on ${data.publishedDate}`,
							title: `${data.title} ${data.subtitle}`,
							image: data.imageLinks.thumbnail,
						}

						ModuleCallback(book)
					}else {
						ModuleCallback(null)
					}
				})
				.fail(_ => ModuleCallback(null))
		}

		module.init()
	}
})
