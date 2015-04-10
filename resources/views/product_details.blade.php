@extends('app')

@section('content')
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="thumbnail">
                <img class="img-responsive" src="../img/products/{{ $product->image }}" alt="">
                <div class="caption-full">
                    <h4 class="pull-right">${{ $product->price }}</h4>
                    <h4><a href="#">{{ $product->product_name }}</a>
                    </h4>
                    <p>{{ $product->description }}</p>
                </div>
                <div class="ratings">
                    <p class="pull-right">{{ $product->rating_count }} reviews</p>
                    <p>
                        @for ($i=1; $i <= 5 ; $i++)
                            <span class="glyphicon glyphicon-star{{ ($i <= $product->rating_cache) ? '' : '-empty'}}"></span>
                        @endfor
                        {{ $product->rating_cache }} stars
                    </p>
                </div>
                <div class="caption">
                    {!! Form::open(['route' => 'add_to_cart']) !!}
                    {!! Form::hidden('product_id', $product->id) !!}
                    <button class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Add to Cart</button>
                    {!! Form::close() !!}
                </div>
            </div>

            <div class="well">
                @if(Auth::user())
                    @include('includes._errorMessages')
                    <div class="form-group">
                        {!! Form::open(['route' => 'store_review', 'class' => 'form-horizontal']) !!}
                            @include('includes._reviewForm')
                        {!! Form::close() !!}
                    </div>
                @else
                    <h6>**To leave a review, please login <a href="{{ asset('auth/login') }}">here</a>**</h6>
                @endif

                @if(!empty($reviews))
                    @foreach($reviews as $review)
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                @for ($i=1; $i <= 5 ; $i++)
                                    <span class="glyphicon glyphicon-star{{ ($i <= $review['ratings']) ? '' : '-empty'}}"></span>
                                @endfor
                                {{ $review['username'] }}
                                <span class="pull-right">{{ $review['created_at'] }}</span>
                                <p>{{ $review['comment'] }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <hr>
                    <h4>There is no review for this product</h4>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- /.container -->
@endsection