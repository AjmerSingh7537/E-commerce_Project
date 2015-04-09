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
            </div>

            <div class="well">
                @if(Auth::user())
                    <div class="form-group">
                        {!! Form::open(['route' => 'store_product', 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            {!! Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5', 'cols' => '10','placeholder' => 'Enter your review here...']) !!}
                        </div>
                        <div class="form-group">
                            <div class="pull-left">
                            {!! Form::input('hidden', 'ratings', null, ['id' => 'hidden_rating_count']) !!}
                            {!! Form::input('number', 'rating-input', '0', [
                                    'class' => 'rating',
                                    'id' => 'rating-input',
                                    'min' => '0', 'max' => '5', 'step' => '0.5', 'data-size' => 'xs'])
                            !!}
                            </div>
                            <div class="pull-right">
                                {!! Form::submit('Submit', ['class' => 'btn btn-success pull-right']) !!}
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-justify">**To leave a review, please login <a href="{{ asset('auth/login') }}">here</a>**</p>
                @endif
                    <hr>
                <div class="row">
                    <div class="col-md-12">
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                        Anonymous
                        <span class="pull-right">10 days ago</span>
                        <p>This product was great in terms of quality. I would definitely buy another!</p>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                        Anonymous
                        <span class="pull-right">12 days ago</span>
                        <p>I've alredy ordered another one!</p>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                        Anonymous
                        <span class="pull-right">15 days ago</span>
                        <p>I've seen some better than this, but not at this price. I definitely recommend this item.</p>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
<!-- /.container -->
@endsection