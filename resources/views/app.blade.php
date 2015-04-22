<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

    <!-- Latest compiled and minified CSS -->
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">--}}

    <!-- The following links are used for the rating stars -->
    <link rel="stylesheet" href="{{ asset('/css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css"/>
    {{--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>--}}
    <script src="/js/jquery.js"></script>
    <script src="{{ asset('/js/star-rating.js') }}" type="text/javascript"></script>

    <!-- CSS for the application -->
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Carousel CSS -->
    <link href="{{ asset('css/carousel.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-inverse" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Laravel</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}"> Home</a></li>
                    <li><a href="{{ route('products_path') }}">Products</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
                    <li>
                        {!! Form::open(['url'=>'#', 'method'=>'GET', 'class'=>'navbar-form navbar-right']) !!}
                        {!! Form::input('search', 'q' ,'', ['class'=>'form-control', 'placeholder'=>'Search...']) !!}
                        {!! Form::close() !!}
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Cart<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/cart/emptyCart') }}"><span class="glyphicon glyphicon-trash"></span> Empty Cart</a></li>
                            <li>
                                <a href="{{ url('/cart') }}"><span class="glyphicon glyphicon-eye-open"></span>
                                    View Cart
                                    @if(!Auth::user())
                                        <p class="pull-right">{{ \Gloudemans\Shoppingcart\Facades\Cart::count() }}</p>
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </li>
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
						<li><a href="{{ url('/auth/register') }}"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('edit_profile', Auth::id()) }}"><span class="glyphicon glyphicon-user"></span> User Profile</a></li>
                                <li><a href="{{ url('#') }}"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ url('/auth/logout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
        @yield('content')
    <script src="/js/ajax_request.js"></script>
    <script src=""></script>
	{{--<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>--}}
</body>
</html>
