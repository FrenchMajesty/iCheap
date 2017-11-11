@section('pageTitle', 'Orders Manager')

@extends ('layouts.admin')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="blue">
                        <h4 class="title">Orders</h4>
                        <p class="category">Here you can manage and edit the desired orders.</p>
                    </div>
                    <div class="card-content table-responsive">
                    	@if(count($orders) > 0)
	                        <table class="table">
	                            <thead class="text-primary">
	                            	<tr><th>Action</th>
	                            	<th>Student</th>
	                            	<th>Book</th>
	                            	<th>Created</th>
									<th>Status</th>
	                            </tr></thead>
	                            <tbody>
	                            	@foreach($orders as $order)
	                            		@php($order->book)
		                                <tr data-id="{{$order->id}}">
		                                	<td class="td-actions text-right">
		                                        <button type="button" rel="tooltip" data-action="received" class="btn btn-primary btn-simple btn-xs" data-original-title="Mark as Received">
		                                            <i class="material-icons">assignment_returned</i>
		                                        </button>
		                                        <button type="button" rel="tooltip" data-action="completed" class="btn btn-success btn-simple btn-xs" data-original-title="Mark as Completed">
		                                            <i class="material-icons">check</i>
		                                        <div class="ripple-container"></div></button>
		                                    </td>
		                                	<td>
		                                		<a href="#" target="_blank">{{$order->user->name}}</a>
		                                	</td>
											<td>
												<button type="button" rel="tooltip" data-action="book" class="btn btn-warning btn-simple btn-xs" data-original-title="See More">
		                                            <i class="material-icons">search</i>
		                                        </button>
											</td>
											<td>{{$order->created_at->diffForHumans()}}</td>
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
    </div>
</div>
@endsection

@section('js')
<script>
	const config = {
		url: {
			edit: '{{route('admin.orders.update')}}',
			delete: '{{route('admin.books.delete.desired')}}',
		},
		orders: {
			status: {
				received: 'SHIPMENT_RECEIVED',
				completed: 'PAYMENT_SENT',
			},
			data: {!! $orders !!}
		},
	}

	requirejs(['app/pages/admin/orders'], module => module(config))
</script>
@endsection