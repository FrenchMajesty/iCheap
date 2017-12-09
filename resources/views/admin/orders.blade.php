@section('pageTitle', 'Orders Manager')

@extends ('layouts.admin')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="blue">
                        <h4 class="title">Selling Orders</h4>
                        <p class="category">Here you can manage and edit the desired orders.</p>
                    </div>
                    <div class="card-content table-responsive">
                    	@if(count($orders) > 0)
	                        <table class="table">
	                            <thead class="text-primary">
	                            	<tr><th>Action</th>
	                            	<th>Student</th>
	                            	<th>Book</th>
	                            	<th>Created On</th>
									<th>Status</th>
	                            </tr></thead>
	                            <tbody>
	                            	@foreach($orders as $order)
		                                <tr data-id="{{$order->id}}">
		                                	<td class="td-actions text-right">
		                                        <button type="button" rel="tooltip" data-original-title="Mark as Received"
		                                        data-action="received" class="btn btn-primary btn-simple btn-xs"
		                                        {{$order->received_at ? 'disabled=true': ''}}>
		                                            <i class="material-icons" data-action="received"
		                                            {{$order->received_at ? 'disabled=true': ''}}
		                                            >assignment_returned</i>
		                                        </button>
		                                        <button type="button" rel="tooltip" data-original-title="Mark as Completed"
		                                        data-action="completed" class="btn btn-success btn-simple btn-xs"
		                                        {{$order->payed_at || !$order->received_at ? 'disabled=true': ''}}>
		                                            <i class="material-icons" data-action="completed"
		                                            {{$order->payed_at || !$order->received_at ? 'disabled=true': ''}}
		                                            >check</i>
		                                        <div class="ripple-container"></div></button>
		                                    </td>
		                                	<td>
		                                		<a href="#{{$order->user->id}}" target="_blank">{{$order->user->name}}</a>
		                                	</td>
											<td>
												{{$order->book->title}} ({{$order->book->isbn}})
												<button type="button" rel="tooltip" data-action="book" class="btn btn-warning btn-simple btn-xs" data-original-title="See More">
		                                            <i class="material-icons">search</i>
		                                        </button>
											</td>
											<td>{{$order->created_at->format('m/d/Y')}} ({{$order->created_at->diffForHumans()}})</td>
		                                	<td>{{$order->status->name}}</td>
											
		                                </tr>
	                                @endforeach
	                            </tbody>
	                        </table>
	                    @else
	                    	<h4 class="text-center">There are no orders to see here..</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="green">
                        <h4 class="title">Orders Paid</h4>
                        <p class="category">Here you see the orders that were paid but not yet fulfilled for books that {{env('APP_NAME')}} bought.</p>
                    </div>
                    <div class="card-content table-responsive">
                    	@if(count($completed) > 0)
	                        <table class="table">
	                            <thead class="text-primary">
	                            	<tr><th>Shipping Details</th>
	                            	<th>Student</th>
	                            	<th>Book</th>
	                            	<th>Order Received On</th>
	                            	<th>Order Paid On</th>
	                            </tr></thead>
	                            <tbody>
	                            	@foreach($completed as $order)
	                            		@php($order->book)
		                                <tr data-id="{{$order->id}}">
		                                	<td>
		                                		<a href="{{$order->paymentShipping->label_url}}" target="_blank" rel="tooltip" class="btn btn-primary btn-simple btn-xs" data-original-title="Open The Label">
		                                            <i class="material-icons">mail_outline</i>
		                                        </a>
		                                        <a href="{{$order->paymentShipping->tracking_url}}" target="_blank" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="Track this Check">
		                                            <i class="material-icons">my_location</i>
		                                        </a>
		                                	</td>
		                                	<td>
		                                		<a href="#" target="_blank">{{$order->user->name}}</a>
		                                	</td>
											<td>
												{{$order->book->title}} ({{$order->book->isbn}})
												<button type="button" rel="tooltip" data-action="book" class="btn btn-warning btn-simple btn-xs" data-original-title="See More">
		                                            <i class="material-icons">search</i>
		                                        </button>
											</td>
											<td>{{$order->created_at->format('M dS, Y \a\t g:iA')}}</td>
											<td>{{$order->paid_at->format('M dS, Y \a\t g:iA')}}</td>
											
		                                </tr>
	                                @endforeach
	                            </tbody>
	                        </table>
	                    @else
	                    	<h4 class="text-center">No orders have been fulfilled yet.</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="gray">
                        <h4 class="title">Orders Fulfilled</h4>
                        <p class="category">Here you see the finished orders for books that {{env('APP_NAME')}} bought.</p>
                    </div>
                    <div class="card-content table-responsive">
                    	@if(count($archives) > 0)
	                        <table class="table">
	                            <thead class="text-primary">
	                            	<tr><th>Details</th>
	                            	<th>Student</th>
	                            	<th>Book</th>
	                            	<th>Book Received On</th>
	                            	<th>Check Delivered On</th>
	                            </tr></thead>
	                            <tbody>
	                            	@foreach($archives as $order)
	                            		@php($order->book)
		                                <tr data-id="{{$order->id}}">
		                                	<td>
		                                        <a href="{{$order->paymentShipping->tracking_url}}" target="_blank" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="Track this Check">
		                                            <i class="material-icons">my_location</i>
		                                        </a>
		                                	</td>
		                                	<td>
		                                		<a href="#" target="_blank">{{$order->user->name}}</a>
		                                	</td>
											<td>
												{{$order->book->title}} ({{$order->book->isbn}})
												<button type="button" rel="tooltip" data-action="book" class="btn btn-warning btn-simple btn-xs" data-original-title="See More">
		                                            <i class="material-icons">search</i>
		                                        </button>
											</td>
											<td>{{$order->received_at->format('M dS, Y \a\t g:iA')}}</td>
											<td>{{$order->deleted_at->format('M dS, Y')}}</td>
											
		                                </tr>
	                                @endforeach
	                            </tbody>
	                        </table>
	                    @else
	                    	<h4 class="text-center">No orders have been fulfilled yet.</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
	const config = {
		url: {
			received: '{{route('admin.orders.update.received')}}',
			completed: '{{route('admin.orders.update.paid')}}',
		},
		orders: {
			status: {
				received: 'SHIPMENT_RECEIVED',
				completed: 'PAYMENT_SENT',
			},
			data: {!! $orders->merge($completed) !!}
		},
	}

	requirejs(['app/pages/admin/orders'], module => module(config))
</script>
@endsection