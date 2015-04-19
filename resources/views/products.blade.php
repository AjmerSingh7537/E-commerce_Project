@extends('app')

@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="caption col-lg-12">
                    {{--<div class="col-md-4 pull-right h1">--}}
                        {{--<select class="form-control">--}}
                            {{--<option>category_name1</option>--}}
                            {{--<option>category_name2</option>--}}
                            {{--<option>category_name3</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-4">--}}
                        {{--<h1>List of Products</h1>--}}
                    {{--</div>--}}
                    <h1>List of Products</h1>
                </div>

                @foreach($products as $product)
                    <div class="col-sm-6 col-lg-3 col-md-4">
                        <div class="thumbnail">
                            <img src="img/products/{{ $product->image }}" alt="">
                            <div class="caption">
                                <h4 class="pull-right">${{ $product->price }}</h4>
                                <h4><a href="{{ route('product_path', $product->slug) }}">{{ $product->product_name }}</a>
                                </h4>
                                <p>{{ str_limit($product->description, 50, $end = '...') }}</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">{{ $product->rating_count }} reviews</p>
                                <p>
                                    @for ($i=1; $i <= 5 ; $i++)
                                        <span class="glyphicon glyphicon-star{{ ($i <= $product->rating_cache) ? '' : '-empty'}}"></span>
                                    @endfor
                                </p>
                            </div>
                            <div class="caption">
                                {!! Form::open(['route' => 'add_to_cart']) !!}
                                {!! Form::hidden('product_id', $product->id) !!}
                                <button class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Add to Cart</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-sm-6 col-lg-3 col-md-4">
                    <h4><a href="#">Like this template?</a>
                    </h4>
                    <p>If you like this template, then check out <a target="_blank" href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">this tutorial</a> on how to build a working review system for your online store!</p>
                    <a class="btn btn-primary" target="_blank" href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">View Tutorial</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->
@endsection