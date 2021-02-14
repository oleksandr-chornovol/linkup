@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <body>
        <div class="container">
            <h2>{{ $product->title }}</h2>

            {{ Form::model($product, array('route' => array('product.update', $product->id), 'method' => 'PUT')) }}

            <div class="form-group">
                {{ Form::label('Title') }}
                {{ Form::text('title', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('Brand') }}
                {{ Form::text('brand', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('Price') }}
                {{ Form::number('price', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('Docket') }}
                {{ Form::textarea('docket', null, array('class' => 'form-control', 'rows' => 2)) }}
            </div>

            {{ Html::ul($errors->all()) }}

            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
        </div>
    </body>
</html>
@endsection
