@extends('admin.admin') @section('main')

<h1>Редакция на <b>"{{$product->ProductName}}"</b></h1>

{!! Form::model($product, array('method' => 'PATCH', 'route' => array('admin.update', $product->ProductID), 'class' => 'form-horizontal', 'files' => true)) !!}
    <div class="form-group">
        <label class="control-label col-sm-2">Име</label>
        <div class="col-sm-10">
            {{Form::text('ProductName', null, ["class" => 'form-control'])}}
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2">Категория</label>
        <div class="col-sm-10">
        <select class="form-control" name="ProductCategory_CategoryID">
            @foreach($categories as $cg)
                <option value="{{ $cg->CategoryID }}">{{ $cg->CategoryName }}</option>
            @endforeach
        </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2">Производител</label>
        <div class="col-sm-10">
            <select class="form-control" name="Manufacturers_ManufacturerID">
				@foreach($manufacturers as $mf)
					<option value="{{ $mf->ManufacturerID }}">{{ $mf->ManufacturerName }}</option>
				@endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2">Цена</label>
        <div class="col-sm-10">
            {{Form::input('number', 'ProductPrice', null, ["class" => 'form-control', "step" => '0.01'])}}
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2">Отстъпка</label>
        <div class="col-sm-10">
            {{Form::input('number', 'ProductDiscount', null, ["class" => 'form-control', "step" => '0.01'])}}
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2">Описание</label>
        <div class="col-sm-10">
            {{Form::textarea('ProductDescription', null, ["class" => 'form-control'])}}
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2">Гаранционен срок</label>
        <div class="col-sm-10">
            {{Form::input('number', 'ProductWarranty', null, ["class" => 'form-control'])}}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                {{ Form::hidden('ProductAvailability', 0) }}
                {{ Form::checkbox('ProductAvailability', $product->ProductAvailability)}}
                Наличен?</<label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div style="position:relative;">
                <a class='btn btn-default' href='javascript:;'>
                Избери изображение
                <input type="file" accept="image/*" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="ProductImage" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
                </a> &nbsp;
                <span class='label label-info' id="upload-file-info"></span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">Редактирай</button>
        </div>
    </div>
{!! Form::close() !!}

@if($errors->any())
    <h4>{{$errors->first()}}</h4>
@endif

<script>
    $('input[type="checkbox"]').change(function() {
        this.value ^= 1;
    });
</script>

@stop