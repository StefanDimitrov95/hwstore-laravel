
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="{{ asset('/css/products.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
	@include('partials._navigation')

	<form method="get" action="filter">
	<div id="filter-wrapper">
		<div class="filter">
			<p>Категория:</p>
			<select name='cg'>
				<option></option>
				@foreach($categories as $cg)
					<option value="{{ $cg->CategoryID }}">{{ $cg->CategoryName }}</option>
				@endforeach
			</select>
		</div>

		<div class="filter">
			<p>Производител:</p>
			<select name='mf'>
				<option></option>
				@foreach($manufacturers as $mf)
					<option value="{{ $mf->ManufacturerID }}">{{ $mf->ManufacturerName }}</option>
				@endforeach
			</select>
		</div>
		<div class="filter">
			<p>Само налични?</p>
			<input type="checkbox" name="available" checked>
		</div>
		
		<div class="filter">
			<p>Ценови диапазон:</p>
			<input type="number" name="low" min="0"> – <input type="number" name="high" min="0">лв.
		</div>
	</div>
		<input type="submit" class="btn btn-default" value="Филтър"></input>
	</form>
	{{ $products->links() }}

	<div id="products-wrapper">
	@foreach($products as $product)
		<div class="product">
			<a href="{{url('/'.$product->ProductID)}}">{{$product->ProductName}}<br>
			<img src="{{ asset($product->ProductImage) }}"/></a>
			<div class="{{$product->ProductDiscount != NULL ? 'sale' : '' }}">
			<p class="price">{{$product->ProductPrice}} лв.</p>
			@if($product->ProductDiscount != NULL)
			<p class="sale">{{$product->ProductPrice - $product->ProductDiscount}} лв.</p>
			@endif
			</div>
		</div>
	@endforeach
	</div>

</body>
</html>