@section('pageTitle', 'Sign In')

@extends('layouts.platform')

@section('content')
<div class="single-product-area">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-1">
                <div class="product-content-right">
                    <div class="woocommerce">

                        <form action="{{route('register')}}" class="checkout" method="post">
                            <div id="customer_details" class="col2-set">
                                <div class="col-1">
                                    <div class="woocommerce-billing-fields">
                                        <h3>Register</h3>
                                        <p>To use {{env('APP_NAME')}} and start buying and selling books right away you must have an account, so what are you waiting for? Sign up below!</p>
                                        
                                        {{ csrf_field() }}
                                        <p class="form-row form-row-first validate-required">
                                            <label>First Name</label>
                                            <input type="text" value="{{old('firstname')}}" placeholder="Enter your first name here" name="firstname" class="input-text" required>
                                        </p>
                                        @if ($errors->has('firstname'))
                                        <span class="help-block red-text">
                                            <strong>{{ $errors->first('firstname') }}</strong>
                                        </span>
                                        @endif

                                        <p class="form-row form-row-last validate-required">
                                            <label>Last Name </label>
                                            <input type="text" value="{{old('lastname')}}" placeholder="Enter your last name" name="lastname" class="input-text" required>
                                        </p>
                                        @if ($errors->has('lastname'))
                                        <span class="help-block red-text">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                                        @endif

                                        <p class="form-row form-row-last validate-required">
                                            <label>Email</label>
                                            <input type="email" value="{{old('new-email')}}" placeholder="Enter your email" name="new-email" class="input-text full-width" required>
                                        </p>
                                        @if ($errors->has('new-email'))
                                        <span class="help-block red-text">
                                            <strong>{{ $errors->first('new-email') }}</strong>
                                        </span>
                                        @endif

                                        <p class="form-row form-row-last validate-required">
                                            <label>Password</label>
                                            <input type="password" value="{{old('password')}}" placeholder="Enter your password" name="password" class="input-text full-width" required>
                                        </p>
                                        @if ($errors->has('password'))
                                        <span class="help-block red-text">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif

                                        <p class="form-row form-row-last validate-required">
                                            <label>Address</label>
                                            <input type="text" value="{{old('address')}}" placeholder="Enter your full address here" name="address" class="input-text" required>
                                        </p>
                                        @if ($errors->has('address'))
                                        <span class="help-block red-text">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                        <div class="clear"></div>
                                        <p>By signing up on {{env('APP_NAME')}}, you attest that you have read the <a href="#">Terms &amp; Conditions of Use</a> and the <a href="#">Privacy Policy</a> and agree with their content.</p>
                                        <button type="submit" class="button col-md-12">Sign up now</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>                       
                </div>                    
            </div>
            <div class="col-md-5">
                <div class="single-sidebar">
                    <form id="login-form-wrap" class="login" method="POST" action="{{ route('login') }}">
                        <h2>Login</h2>

                        <p>If you have an account, please enter your details to login below. If you are a new around, fill out the register section on the left.</p>

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
                        
                        <p class="form-row form-row-last">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="input-text full-width" placeholder="Enter your password" required>
                        </p>
                        <div class="clear"></div>
                        <p class="form-row">
                            <input type="submit" value="Login" name="login" class="button col-md-12">
                            <label class="inline" for="rememberme">
                                <input type="checkbox" name="rememberme" {{ old('remember') ? 'checked' : '' }}> Remember me 
                            </label>
                        </p>
                        <p class="lost_password">
                            <a href="{{ route('password.request') }}">Lost your password?</a>
                        </p>

                        <div class="clear"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
