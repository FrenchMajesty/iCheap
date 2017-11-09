<script data-template="edit-book" type="text/x-handlebars-template">
	<form id="edit-book" class="row" method="POST" action="{{route('admin.books.update.desired')}}">
		<div class="row">
			{{ csrf_field() }}
			<input type="hidden" name="id" value="@{{id}}">
		    <div class="col-md-12">
				<div class="form-group label-floating is-empty">
					<label class="control-label">Price</label>
					<input type="number" name="price" class="form-control" value="@{{price}}" step="any" required>
				<span class="material-input"></span></div>
		    </div>
		</div>
		<div class="row">
			<section class="error"></section>
		</div>
	</form>
</script>
<script data-template="name" type="text/x-handlebars-template"></script>