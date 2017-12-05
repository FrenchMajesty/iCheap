@section('pageTitle', 'My Account')

@extends('layouts.platform')

@section('content')
<div class="single-product-area">
    <div class="container">
        <div class="row">
           <div class="col-md-4">
            <div id="orders-history" class="orders single-sidebar">
                @php($allOrdersCount = $user->orders->count() + $user->ordersDone->count())
                <h2 class="sidebar-title">Orders History</h2>
                <form id="search" action="">
                    <input type="text" placeholder="Search by ISBN, Title, author, or whatever...">
                    <input type="submit"  value="Search" {{$allOrdersCount == 0 ? 'class=disabled disabled' : ''}}>
                </form>
            </div>

            @if($allOrdersCount == 0)
            <p>This column is empty because you haven't made any transaction on {{env('APP_NAME')}} yet.. What are you waiting for?!</p>
            @endif

            @if($user->orders->count() > 0)
            <div class="single-sidebar">
                <h2 class="sidebar-title">Pending Orders</h2>

                @foreach($user->orders as $order)
                <div class="thubmnail-recent" data-order data-isbn="{{$order->book->isbn}}">
                 <div class="col-md-3">
                    <img src="{{$order->book->image}}" class="recent-thumb" alt="">
                </div>
                
                <h2><a href="#">{{$order->book->title}}</a></h2>
                <div class="product-sidebar-price col-md-8">
                    Book's approximate value: <ins>${{$order->book->price}}</ins><br>
                    Status: {{$order->status->name}}<br>
                    Author(s): {{$order->book->authors}}<br>
                    ISBN: {{$order->book->isbn}}<br>
                </div>                          
            </div>
            @endforeach
        </div>
        @endif

        @if($ordersDone->count() > 0)
        <div class="single-sidebar">
            <h2 class="sidebar-title">Orders Completed</h2>

            @foreach($ordersDone as $order)
            <div class="thubmnail-recent" data-order data-isbn="{{$order->book->isbn}}">
             <div class="col-md-3">
                <img src="{{$order->book->image}}" class="recent-thumb" alt="">
            </div>

            <h2><a href="#">{{$order->book->title}}</a></h2>
            <div class="product-sidebar-price col-md-8">
                Amount Received: <ins>${{$order->payment_amount}}</ins><br>
                Date completed: {{$order->created_at->format('M d, Y')}}<br>
                Author(s): {{$order->book->authors}}<br>
                ISBN: {{$order->book->isbn}}<br>
            </div>                          
        </div>
        @endforeach

        {{ $ordersDone->links() }}
    </div>
    @endif
</div>
<div class="col-md-8">
    <div class="product-content-right">
        <div class="woocommerce">


            <form action="{{route('account.update')}}" class="checkout" method="POST">
                {{csrf_field()}}
                <div id="customer_details" class="col2-set">
                    <h3>Account Details</h3>
                    <div class="col-1">
                        <div class="woocommerce-billing-fields">
                            <p class="form-row form-row-first validate-required">
                                <label>First Name</label>
                                <input type="text" value="{{old('firstname') ?: $user->firstname}}" placeholder="Enter your first name" name="firstname" class="input-text" required>
                            </p>
                            @if ($errors->has('firstname'))
                            <span class="help-block red-text">
                                <strong>{{ $errors->first('firstname') }}</strong>
                            </span>
                            @endif

                            <div class="clear"></div>
                            <p class="form-row form-row-wide">
                                <label>Address</label>
                                <input type="text" value="{{old('address') ?: $user->address->formatted}}" placeholder="Enter your mailing address" name="address" class="input-text" required>
                            </p>
                            @if ($errors->has('address'))
                            <span class="help-block red-text">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                            @endif

                            <div class="clear"></div>
                        </div>
                        <p>
                            <button type="submit" class="button full-width">Save My Informations</button>
                        </p>
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                    </div>
                    <div class="col-2">
                        <p class="form-row form-row-last validate-required">
                            <label>Last Name</label>
                            <input type="text" value="{{old('lastname') ?: $user->lastname}}" placeholder="Enter your last name" name="lastname" class="input-text" required>
                        </p>
                        @if ($errors->has('lastname'))
                        <span class="help-block red-text">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>
                        @endif

                    </div>

                </div>
            </form>
            <div class="woocommerce-info">Change your password? <a class="showlogin" data-toggle="collapse" href="#login-form-wrap" aria-expanded="false" aria-controls="login-form-wrap">Click here to update it</a>
            </div>

            <form id="login-form-wrap" class="login collapse {{$errors->has('password') || session('password-status') ? 'in': ''}} col-md-8" method="post" action="{{route('password.update')}}">
                {{csrf_field()}}

                <div class="col-md-10">
                    <p>Make sure that your password is at least 6 characters long and is secure.</p>

                    <p class="form-row form-row-first">
                        <label for="username">Password</label>
                        <input type="password" name="password" placeholder="Enter your new password" class="input-text full-width" {{$errors->has('password') ? 'autofocus' : ''}} required>   
                    </p>
                    @if ($errors->has('password'))
                    <span class="help-block red-text">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                    <p class="form-row form-row-last">
                        <label for="password">Confirm Password</label>
                        <input type="password" name="password_confirmation" placeholder="Repeat your new password" class="input-text full-width" required>
                    </p>
                    <div class="clear"></div>


                    <p class="form-row">
                        <input type="submit" value="Update Password" name="login" class="button full-width">
                    </p>
                    @if (session('password-status'))
                    <div class="alert alert-success">
                        {{ session('password-status') }}
                    </div>
                    @endif
                    <div class="clear"></div>
                </div>
            </form>
        </div>                       
    </div>                    
</div>
</div>
</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    requirejs(['app/pages/platform/account'])
</script>
@endsection