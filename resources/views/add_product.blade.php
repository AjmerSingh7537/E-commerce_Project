@extends('app')

@section('content')

    <div class="container col-md-4 col-md-offset-4">
        <div class="row">
            <h1>Add Product</h1>
            {!! Form::open(['route' => 'products.store']) !!}
                <div class="form-group {{ $errors->has('product_name') ? 'has-error' : '' }}">
                    {!! Form::label('product_name', 'Product Name:') !!}
                    {!! Form::text('product_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('product_name', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    {!! Form::label('description', 'Description:') !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                    {!! Form::label('price', 'Price:') !!}
                    {!! Form::text('price', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('price', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->has('image_path') ? 'has-error' : '' }}">
                    {!! Form::label('image_path', 'Image Path:') !!}
                    {!! Form::file('image_path', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('image_path', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->has('rating_cache') ? 'has-error' : '' }}">
                    {!! Form::label('rating_cache', 'Rating Cache:') !!}
                    {!! Form::text('rating_cache', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('rating_cache', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->has('rating_count') ? 'has-error' : '' }}">
                    {!! Form::label('rating_count', 'Rating Count:') !!}
                    {!! Form::text('rating_count', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('rating_count', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Add Product', null, ['class' => 'btn btn-default']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection