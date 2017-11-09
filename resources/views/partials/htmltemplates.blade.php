<script data-template="edit-book" type="text/x-handlebars-template">
	<div class="row">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="@{{id}}">
	    <div class="col-md-6">
			<div class="form-group label-floating is-empty">
				<label class="control-label">ISBN</label>
				<input type="text" name="isbn" class="form-control" value="@{{isbn}}" required>
			<span class="material-input"></span></div>
	    </div>
	    <div class="col-md-6">
			<div class="form-group label-floating is-empty">
				<label class="control-label">Price</label>
				<input type="number" name="price" class="form-control" value="@{{price}}" step="any" required>
			<span class="material-input"></span></div>
	    </div>
	</div>
</script>
<script data-template="name" type="text/x-handlebars-template"></script>