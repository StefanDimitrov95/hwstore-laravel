@extends('admin.admin') @section('main')

<h1>Добавяне на продукт</h1>

{!! Form::open(array('route' => 'admin.store', 'method' => 'post', 'class' => 'form-horizontal', 'files' => true)) !!}
    <div class="form-group">
        <label class="control-label col-sm-2">Име</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="ProductName" required>
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
            <input type="number" step="0.01" class="form-control" name="ProductPrice" required>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2">Отстъпка</label>
        <div class="col-sm-10">
            <input type="number" step="0.01" class="form-control" name="ProductDiscount">
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
            <input type="number" class="form-control" name="ProductWarranty">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label><input type="checkbox" name='ProductAvailability' value="1" checked>Наличен?</label>
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
            <button type="reset" class="btn btn-danger">Изчистване</button>
            <button type="submit" class="btn btn-success">Добави</button>
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