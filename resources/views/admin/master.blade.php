<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Laravel</title>

    <!-- Font awesome css -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    {!! Html::style('/css/bootstrap.min.css') !!}
    {!! Html::style('/admin/css/metisMenu.min.css') !!}
    {!! Html::style('/admin/css/dataTables.bootstrap.css') !!}
    {!! Html::style('/admin/css/dataTables.responsive.css') !!}
    {!! Html::style('/admin/css/sb-admin-2.css') !!}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Laravel</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Messages"><span class="glyphicon glyphicon-envelope"></span></a></li>
            <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Tasks"><span class="glyphicon glyphicon-tasks"></span></a></li>
            <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Notifications"><span class="glyphicon glyphicon-bell"></span></a></li>
            <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Profile"><span class="glyphicon glyphicon-user"></span></a></li>
            <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Settings"><span class="glyphicon glyphicon-cog"></span></a></li>
            <li><a href="{{ url('/auth/logout') }}" data-toggle="tooltip" data-placement="bottom" title="Logout"><span class="glyphicon glyphicon-log-out"></span></a></li>
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li><a href="{{ url('/home') }}">Products</a></li>
                    <li><a href="{{ route('categories') }}">Categories</a></li>
                    <li><a href="{{ route('list_users') }}">Users</a></li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>
    <div id="page-wrapper">
        @yield('content')
    </div>
</div>

<!-- Scripts -->
{!! Html::script('/js/jquery.js') !!}
{!! Html::script('/js/bootstrap.min.js') !!}
{!! Html::script('/admin/js/metisMenu.min.js') !!}
{!! Html::script('/admin/js/jquery.dataTables.min.js') !!}
{!! Html::script('/admin/js/dataTables.bootstrap.min.js') !!}
{!! Html::script('/admin/js/sb-admin-2.js') !!}

<!-- The following code will be put in a JS file -->
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true,
            "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [1, 6] }]
        });
        $('#sort_users').DataTable({
            responsive: true,
            "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [4] }]
        });
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

</body>

</html>
