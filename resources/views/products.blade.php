@extends('app')

@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-lg-12">
                    <h1>List of Products</h1>
                </div>

                @foreach($products as $product)
                    <div class="col-sm-6 col-lg-3 col-md-4">
                        <div class="thumbnail">
                            <img src="img/products/{{ $product->image }}" alt="">
                            <div class="caption">
                                <h4 class="pull-right">${{ $product->price }}</h4>
                                <h4><a href="{{ route('product_path', $product->id) }}">{{ $product->product_name }}</a>
                                </h4>
                                <p>{{ $product->description }}</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">{{ $product->rating_count }} reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
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