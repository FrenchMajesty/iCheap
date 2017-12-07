@section('pageTitle', 'Books Manager')

@extends ('layouts.admin')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="blue">
                        <h4 class="title">Users</h4>
                        <p class="category">Here you see all of the registered users and their account informations.</p>
                    </div>
                    <div class="card-content table-responsive">
                    	@if(count($users) > 0)
	                        <table class="table">
	                            <thead class="text-primary">
	                            	<tr><th>Name</th>
	                            	<th>Email</th>
	                            	<th>Email is Verified</th>
	                            	<th>Address</th>
	                            	<th>Account</th>
									<th>Date Registered</th>
	                            </tr></thead>
	                            <tbody>
	                            	@foreach($users as $user)
		                                <tr>
		                                	<td>{{$user->name}}</td>
		                                	<td>{{$user->email}}</td>
		                                	<td>{{$user->email_verified ? 'Yes' : 'No'}}</td>
		                                	<td>{{$user->address->formatted}}</td>
		                                	<td>{{ucfirst($user->account).' '.($user->rank > 0 ? '(Rank: '.$user->rank.')' : '')}}</td>
		                                	<td>{{$user->created_at->format('M d, Y')}}</td>
		                                </tr>
	                                @endforeach
	                            </tbody>
	                        </table>
	                    @else
	                    	<h4 class="text-center">There are no users to see here..</h4>
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
	requirejs(['app/ui-mod/datatable'], DataTables => DataTables(['table']))
</script>
@endsection