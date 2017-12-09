<script data-template="edit-book" type="text/x-handlebars-template">
	<form id="edit-book" class="row" method="POST" action="{{route('admin.books.update.desired')}}">
		<div class="row">
			{{ csrf_field() }}
			<input type="hidden" name="id" value="@{{id}}">
		    <div class="col-md-12">
				<div class="form-group label-floating is-empty">
					<label class="control-label">Price</label>
					<input type="number" name="price" class="form-control" value="@{{price}}" step="any" required>
					<span class="material-input"></span>
				</div>
		    </div>
		</div>
		<div class="row">
			<section class="error"></section>
		</div>
	</form>
</script>
<script data-template="order-book-details" type="text/x-handlebars-template">
	<div class="card card-profile container">
		<div class="content"><br/>
			<img src="@{{image}}" style="width: 80%">
			<h4 class="card-title">@{{title}}</h4>
			<p class="card-content">
				@{{{additional}}}
			</p>
		</div>
	</div>
</script>
<script data-template="order-fulfill" type="text/x-handlebars-template">
	<form class="row" id="order-fulfill" method="POST" action="{{route('admin.orders.update.paid')}}">
		{{csrf_field()}}
		<input type="hidden" name="id" value="@{{id}}">
		<div class="col-md-12">
			<div class="form-group label-floating is-empty">
				<label class="control-label">Amount of the Price Paid</label>
				<input type="number" name="amount" class="form-control" value="@{{price}}" step="any" required>
				<span class="material-input"></span>
			</div>
		</div>
	</form>
</script>
<script data-template="name" type="text/x-handlebars-template"></script>