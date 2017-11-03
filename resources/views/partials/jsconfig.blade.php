<script data-main="{{asset('js/app')}}" src="{{asset('js/lib/require.js')}}"></script>
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
        },
    })
</script>