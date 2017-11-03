@section('pageTitle', 'Add a new desired book - '.env('APP_NAME'))

@extends ('layouts.admin')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" data-background-color="blue">
                        <h4 class="title">Add a Book</h4>
						<p class="category">A book we want to purchase from students</p>
                    </div>
                    <div class="card-content">
                        <form method="POST" action="">
                        	{{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
									<div class="form-group label-floating is-empty">
										<label class="control-label">ISBN</label>
										<input type="text" name="isbn" class="form-control" required>
									<span class="material-input"></span></div>
                                </div>
                                <div class="col-md-6">
									<div class="form-group label-floating is-empty">
										<label class="control-label">Price</label>
										<input type="number" name="price" class="form-control" required>
									<span class="material-input"></span></div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-info btn-lg col-md-4 pull-right">Add the New Book</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
			<div class="col-md-4">
				<div class="card card-profile">
					<div class="content"><br/>
						<p class="category text-gray">Enter the Book's ISBN To load its information</p>
						<h4 class="card-title">Title</h4>
						<p class="card-content">
							Additional information..
						</p>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection