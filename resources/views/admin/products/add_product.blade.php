@extends('admin.master')

@section('content')
    <div class="container-fluid">
        <div class="row" style="margin-top: 50px;">
            <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">Add Product</div>
                    <div class="panel-body">
                        @include('includes._errorMessages')
                        {!! Form::open(['route' => 'store_product', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                            @include('includes._productForm')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection