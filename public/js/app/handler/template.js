/*
    |--------------------------------------------------------------------------
    | Template Module
    |--------------------------------------------------------------------------
    |
    | This module is used for faster Handlebars templating.
    |
    */
define(['handlebars'], (Handlebars) => { 
	
	return (option) => {
		const module = {
			options: {
				name: option || null,
			},
		}

		/**
		 * Compile raw HTML for Handlebars template generator
		 * @return {Function} Template generator
		 */
		function compileTemplate() {
			const template = module.options.name
			const raw = $(`script[data-template="${template}"]`).html()

			return Handlebars.compile(raw)
		}

		return compileTemplate()
	}
})
