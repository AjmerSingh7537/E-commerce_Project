@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Product</div>
                    <div class="panel-body">
                        @include('includes/_errorMessages')
                        {!! Form::model($product, ['route' => 'update_product', 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
                            @include('includes/_productForm')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection