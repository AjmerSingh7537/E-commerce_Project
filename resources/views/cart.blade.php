@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
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
                                <table class="table">
                                    @foreach($items as $index => $item)
                                        <tr>
                                            <td style="width: 100px;">
                                                <img src="img/products/{{ $item['image'] }}" style="width:150px;height: 78px;">
                                            </td>
                                            <td>{{ $item['product_name'] }}</td>
                                            <td class="text-center">${{ $item['price'] }}</td>
                                            <td class="text-center">
                                                <input class="text-center" type="text" value="{{ $item['quantity'] }}" style="width: 20px;">
                                            </td>
                                            <td class="text-right">
                                                <p>${{ $item['quantity_price'] }}</p>
                                                @if(Auth::user())
                                                    <p>{!! delete_form(['delete_item', $item['product_id']]) !!}</p>
                                                @else
                                                    <p>{!! delete_form(['delete_item', $index]) !!}</p>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                <div>
                                    <p class="text-right">Cart Subtotal: {{ Session::get('subtotal') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection