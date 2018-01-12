<script data-main="{{asset('public/js/app')}}" src="{{asset('public/js/lib/require.js')}}"></script>
<script type="text/javascript">
    // Application-wide configs
    define('config', {
    	cloudinary: {
    		key: '{{env('CLOUDINARY_KEY')}}',
    		url: '{{env('CLOUDINARY_URL')}}',
    	},
    	recaptcha: {
    		key: '{{env('GOOGLE_RECAPTCHA_KEY')}}',
    	},
        google: {
            key: '{{env('GOOGLE_API_KEY')}}',
            map: {
                key: '{{env('GOOGLE_MAPS_API_KEY')}}',
            },
        },
    })
</script>