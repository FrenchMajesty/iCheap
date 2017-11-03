
requirejs.config({
	baseUrl: '/iCheap/public/js/lib',
	paths: {
		app: '../app',
		jquery: '//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min',
		bootstrap: '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min',
		facebook: '//connect.facebook.net/en_US/sdk',
		sweetalert: '//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.4/sweetalert2.all.min',
	},
	shim: {
		'bootstrap': {
			deps: ['jquery'],
		},
		'facebook': {
			exports: 'FB',
		},
		'dataTables.bootstrap4.min': {
			deps: ['jquery'],
		},
		'jquery.dataTables.min': {
			deps: ['jquery'],
			exports: 'jQuery.fn.DataTable',
		},
	}
})