@section('pageTitle', '')

@extends ('layouts.admin')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="blue">
                        <h4 class="title">Books</h4>
                        <p class="category">Here you can manage and edit the desired books.</p>
                    </div>
                    <div class="card-content table-responsive">
                    	@if(count($books) > 0)
	                        <table class="table">
	                            <thead class="text-primary">
	                            	<tr><th>View More</th>
	                            	<th>ISBN</th>
	                            	<th>Price</th>
									<th>Status</th>
									<th>Edit</th>
	                            </tr></thead>
	                            <tbody>
	                            	@foreach($books as $book)
		                                <tr>
		                                	<td>Dakota Rice</td>
		                                	<td>{{$book->isbn}}</td>
											<td class="text-primary">${{$book->price}}</td>
		                                	<td>{{$book->status}}</td>
											<td class="td-actions text-right">
		                                        <button type="button" rel="tooltip" title="edit" class="btn btn-primary btn-simple btn-xs" data-original-title="Edit Book">
		                                            <i class="material-icons">edit</i>
		                                        </button>
		                                        <button type="button" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs" data-original-title="Remove">
		                                            <i class="material-icons">close</i>
		                                        <div class="ripple-container"></div></button>
		                                    </td>
		                                </tr>
	                                @endforeach
	                            </tbody>
	                        </table>
	                    @else
	                    	<h4 class="text-center">There are no books to see here..</h4>
                        @endif
                        <div class="text-center">
	                        <a class="btn btn-info" href="{{route('admin.books.add.desired')}}">Add a Book</a>
	                    </div>
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
			edit: '{{route('admin.books.update.desired')}}',
			delete: '{{route('admin.books.delete.desired')}}',
		},
	}
	
	requirejs(['app/pages/admin/books'], module => module(config))
</script>
@endsection