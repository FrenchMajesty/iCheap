@extends ('layouts.platform')

@section('pageTitle', 'Contact Us')

@section('content')
<div class="single-product-area">
    <div class="container">
        <div class="row">
			<div class="col-sm-6 col-sm-offset-3">
			    <div class="product-content-right">
			        <div class="woocommerce">
		                <div id="customer_details" class="col2-set">
		                    <h3>We Would love to hear from you!</h3>
		                    <p>If you have a question about anything or need techinical and sales support, fill out this form and someone from our team will reach back to you ASAP!</p>

	                        <form method="POST" action="" class="woocommerce-billing-fields">
	                        	@php($user = \Auth::user())
	                        	{{ csrf_field( )}}
	                            <p class="form-row form-row-wide">
	                                <label>Your Name</label>
	                                <input type="text" value="{{old('name') ? old('name') : ($user ? $user->name : '')}}" placeholder="Enter your name" name="name" class="input-text" required>
	                            </p>

	                            @if($errors->has('name'))
	                           		<p class="red-text">{{$errors->first('name')}}</p>
	                            @endif

	                            <p class="form-row form-row-wide">
	                                <label>Your Email</label>
	                                <input type="email" value="{{old('email') ? old('email') : ($user ? $user->email : '')}}" placeholder="Enter your email" name="email" class="input-text full-width" required>
	                            </p>

	                            @if($errors->has('email'))
	                           		<p class="red-text">{{$errors->first('email')}}</p>
	                            @endif

	                            <p class="form-row form-row-wide">
	                                <label>Your Message</label>
	                                <textarea name="message" placeholder="Enter your message" rows="5" maxlength="5000" {{$user ? 'autofocus': ''}} required>{{old('message')}}</textarea>
	                            </p>

	                            @if($errors->has('message'))
	                           		<p class="red-text">{{$errors->first('message')}}</p>
	                            @endif
	                            
	                            @if (session('status'))
		                        <div class="alert alert-success">
		                            {{ session('status') }}
		                        </div>
		                        @endif
		                        
	                            <div class="clear"></div>
		                        <p><button id="send" type="submit" class="button full-width">Send My Message</button></p>
	                        </form>
		                </div>
			        </div>                       
			    </div>                    
			</div>
		</div>
	</div>
</div>
@endsection