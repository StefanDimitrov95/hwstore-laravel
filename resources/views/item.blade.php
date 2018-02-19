
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="{{ asset('/css/item.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
	@include('partials._navigation')

	<div class="product">
		<p>{{$product->ProductName}}</p>
		<div class="col-sm-6">
			<img src="{{ asset($product->ProductImage) }}"/>
		</div>
		<div class="col-sm-6">
			<div class="{{$product->ProductDiscount != NULL ? 'sale' : '' }}">
				<p class="price">Цена: {{$product->ProductPrice}} лв.</p>
				@if($product->ProductDiscount != NULL)
				<p class="sale">Цена с намаление: {{$product->ProductPrice - $product->ProductDiscount}} лв.</p>
				@endif
				@if(!$product->ProductAvailability)
				<p id="outOfStock">!!! НЯМА НАЛИЧНОСТ !!!</p>
				@endif
				<p class="descriptionLabel">Описание:</p><pre><span>{{$product->ProductDescription}}</span></pre>
			</div>
		</div>
	</div>

	<table class="table table-striped">

		<thead>
	    <tr>
			<th>Име</th>
			<th>Дата на поръчка</th>
			<th>Стойност</th>
			<th>Брой</th>
			<th>Обща стойност</th>
	    </tr>
		</thead>
		<tbody>
		@foreach($buyers as $buyer)
			<tr>
				<td>{{$buyer->Name.' '.$buyer->Surname}}</td>
				<td>{{$buyer->Order_date}}</td>
				<td>{{$buyer->Order_Price}} лв.</td>
				<td>{{$buyer->Amount}}</td>
				<td>{{$buyer->Amount * $buyer->Order_Price}} лв.</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</body>
</html>