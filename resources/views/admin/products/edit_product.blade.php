@extends('admin.master')

@section('content')
    <div class="container-fluid">
        <div class="row" style="margin-top: 50px;">
            <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">Update Product</div>
                    <div class="panel-body">
                        @include('includes._errorMessages')
                        {!! Form::model($product, ['route' => ['update_product', $product->slug], 'method' => 'PATCH', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}
                            @include('includes._productForm')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection