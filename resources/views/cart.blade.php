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
                                @foreach($items as $index => $item)
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
                                            {!! Form::open(['data-remote', 'method' => 'PATCH', 'route' => ['update_cart', $index]]) !!}
                                            {!! Form::input('number', 'qty', $item['qty'],
                                            ['class' => 'form-control text-center', 'min' => 1, 'style' => 'width: 40px;']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                        <div class="col-lg-2 text-right">
                                            @if(Auth::user())
                                                <h4 id="{{ $index }}">{{ $item['subtotal'] }}</h4>
                                            @else
                                                <h4 id="{{ $item['rowid'] }}">{{ $item['subtotal'] }}</h4>
                                            @endif
                                        </div>
                                        <div class="col-md-12"><hr></div>
                                        <div class="col-md-10 h5">
                                            Availability: <small>In stock</small>
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
                                @endforeach
                                <div class="col-md-12">
                                    <div class="col-md-11 text-right">
                                        <label class="control-label">Cart Subtotal:</label>
                                    </div>
                                    <div class="col-md-1 text-right">
                                        <p id="total" class="form-control-static">{{ Session::get('subtotal') }}</p>
                                        <p id="total123" class="form-control-static"></p>
                                    </div>
                                </div>
                                <div class="list-inline">
                                    <li><a href="{{ route('products_path') }}" class="btn btn-primary"><span class="glyphicon glyphicon-home"></span> Continue Shopping</a></li>
                                    @if(!Auth::user())
                                        <li><a href="{{ url('auth/login') }}" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save Cart</a></li>
                                    @endif
                                    <div class="pull-right">
                                        <li><a href="#" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Checkout</a></li>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
