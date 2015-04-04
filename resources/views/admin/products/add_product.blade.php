@extends('admin.master')

@section('content')
    <div class="container-fluid">
        <div class="row" style="margin-top: 50px;">
            <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">Add Product</div>
                    <div class="panel-body">
                        @include('includes._errorMessages')
                        {!! Form::open(['route' => 'products.store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group">
                                {!! Form::label('category_id', 'Category', ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            @include('includes._productForm')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection