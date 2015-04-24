@extends('app')

@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="caption col-md-12">
                    <h1 class="col-md-3 col-sm-3 pull-right">
                        {!! Form::open(['selectedCategory', 'url' => 'sortByCategory', 'id' => 'selectedCategory']) !!}
                        {!! Form::select('category', $categories, null, ['class' => 'form-control', 'id' => 'category']) !!}
                        {!! Form::close() !!}
                    </h1>
                    <h1>List of Products</h1>
                </div>
                <div id="testing">
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
                                        <span class="glyphicon glyphicon-star{{ ($i <= round($product->rating_cache)) ? '' : '-empty'}}"></span>
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
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->
@endsection