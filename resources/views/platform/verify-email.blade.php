@section('pageTitle', 'Verify your Email Address to Continue')

@extends('layouts.platform')

@section('content')
<div class="single-product-area">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <form action="{{route('register')}}" class="checkout" method="post">
                            <div id="customer_details" class="col2-set">
                                <div class="woocommerce-billing-fields">
                                    <h3>Your Email Address has not been Verified </h3>
                                    <p style="font-size: 1.5em">To use {{env('APP_NAME')}} and start buying and selling books you need to verify your address email because we send important informations to your inbox about your account, your purchases and your orders.</p>
                                </div>
                            </div>
                        </form>

                    </div>                       
                </div>                    
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="single-sidebar">
                    <form id="login-form-wrap" class="login" method="POST" action="{{ route('request.verify.email') }}">
                        <h2>You didn't receive anything?</h2>

                        <p>Enter your address email below and we will send you another verification email to your inbox.</p>
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                        {{ csrf_field() }}
                        <p class="form-row form-row-first">
                            <label for="username">Email</label>
                            <input type="text" name="email" class="input-text full-width" value="{{ old('email') }}" placeholder="Enter your email" required>
                        </p>
                        @if ($errors->has('email'))
                        <span class="help-block red-text">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                        <div class="clear"></div>
                        <p class="form-row">
                            <input type="submit" value="Send Me A Verification link" name="login" class="button col-md-12">
                        </p>
                        <p class="lost_password">.</p>

                        <div class="clear"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&libraries=geometry,places" type="text/javascript"></script>
<script type="text/javascript">
    requirejs(['app/pages/platform/login'])
</script>
@endsection
