@extends('app')

@section('content')
    @include('includes/_sidebarNavigations')
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="container-fluid">
        <div class="col-md-12 col-md-offset-0">

                {{--@include('includes/_sidebarNavigations')--}}
                <div class="caption col-lg-12">
                    @if(Auth::user() && Auth::user()->type_id === 2)
                        <h1><a href="{{ route('add_product_path') }}" class=" pull-right btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add</a></h1>
                    @endif
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
                            @if(Auth::user() && Auth::user()->type_id === 2)
                                <div class="caption">
                                    <a href="{{ route('edit_product', $product->slug) }}" class="pull-right btn btn-primary">
                                        <span class="glyphicon glyphicon-edit"></span> Edit</a>
                                    {!! delete_form(['products.destroy', $product->slug]) !!}
                                </div>
                            @else
                                <div class="caption">
                                    {!! Form::open(['route' => 'add_to_cart']) !!}
                                    {!! Form::hidden('product_id', $product->id) !!}
                                    <button class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Add to Cart</button>
                                    {{--<a class="btn btn-success">--}}
                                        {{--<span class="glyphicon glyphicon-plus-sign"></span> Add to Cart</a>--}}
                                    {!! Form::close() !!}
                                </div>
                            @endif
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
    <!-- /.container -->
    </div>
@endsection