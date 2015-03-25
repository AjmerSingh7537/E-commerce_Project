@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Product</div>
                    <div class="panel-body">
                        @include('_errorMessages')
                        {!! Form::open(['route' => 'products.store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                            @include('_productForm')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection