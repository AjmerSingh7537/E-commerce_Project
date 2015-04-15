@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h1>Items in Your Cart</h1>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        @if(empty($items))
                            <div class="text-center">
                                <p><b>There are no items in your Cart.</b></p>
                                @if(!Auth::user())
                                    <p><b>If you already have an account, <a href="auth/login"> Sign In </a> to see your Cart.</b></p>
                                @endif
                                <p><a href="{{ route('products_path') }}" class="btn btn-success"><span class="glyphicon glyphicon-home"></span> Continue Shopping</a></p>
                            </div>
                        @else
                            <div class="container-fluid">
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <img src="img/products/{{ $item['options']['image'] }}" style="width:170px;height: 100px;">
                                    </div>
                                    <div class="col-md-10">
                                        <div class="col-md-6">
                                            <h4>{{ $item['name'] }}</h4>
                                        </div>
                                        <div class="col-lg-2 text-center">
                                            <h4>{{ $item['price'] }}</h4>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            {!! Form::open(['route' => ['update_cart', $index], 'method' => 'PATCH']) !!}
                                            {!! Form::input('number', 'qty', $item['qty'],
                                            ['class' => 'form-control text-center', 'min' => 1, 'style' => 'width: 40px;']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                        <div class="col-lg-2 text-right">
                                            <h4>{{ $item['subtotal'] }}</h4>
                                        </div>
                                        <div class="col-md-12"><hr></div>
                                        <div class="col-md-10 h6">
                                            Availability: In stock
                                        </div>
                                        <div class="col-md-2 text-right">
                                            {!! delete_form(['delete_item', $index]) !!}
                                        </div>
                                        <div class="col-md-8">
                                            {{ $item['options']['description'] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12"><hr></div>
                                <div class="col-md-12">
                                    <div class="col-md-2 col-md-offset-10 pull-right">
                                    <p>Cart Subtotal: {{ Session::get('subtotal') }}</p>
                                    <p>Estimated Tax: </p>
                                    <p>Total: </p>
                                    </div>
                                    <hr class="col-md-12">
                                </div>
                                <div class="list-inline">
                                    <li><a href="{{ route('products_path') }}" class="btn btn-success"><span class="glyphicon glyphicon-home"></span> Continue Shopping</a></li>
                                    @if(!Auth::user())
                                        <li><a href="{{ url('auth/login') }}" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Save Cart</a></li>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection