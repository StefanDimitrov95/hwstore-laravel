@extends('admin.admin')
@section('main')

<h1>Всички продукти</h1>

<a href="{{ url('admin/create') }}" class="btn btn-success" role="button" style="margin-bottom:1em;">Добави продукт</a>

@if ($products->count())
<form method="GET" action="admin">
    <div class="input-group">
    <input type="text" class="form-control" name="search" placeholder="Търсене...">
    <span class="input-group-btn">
        <button class="btn btn-default" type="submit">
            Търси
        </button>
    </span>
    </div>
</form>
<br>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ProductID</th>
            <th>ProductName</th>
            <th>ProductAvailability</th>
            <th>ProductPrice</th>
            <th>ProductDiscount</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->ProductID }}</td>
            <td><a href="{{url('/'.$product->ProductID)}}">{{ $product->ProductName }}</td>
            <td>{{ $product->ProductAvailability }}</td>
            <td>{{ $product->ProductPrice }}</td>
            <td>{{ $product->ProductDiscount }}</td>
            <td>{{ link_to_route('admin.edit', 'Редактиране', array($product->ProductID), array('class' => 'btn btn-info')) }}</td>
            <td>
            {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.destroy', $product->ProductID))) }}
            {{ Form::submit('Изтриване', array('class' => 'btn btn-danger')) }}
            {{ Form::close() }}
            </td>
        </tr>
        @endforeach

    </tbody>

</table>
{{ $products->links() }}
</ul>   
@else <h1>Няма намерени продукти</h1> @endif 

@stop