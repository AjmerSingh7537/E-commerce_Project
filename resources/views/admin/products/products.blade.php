@extends('admin.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="caption">
                <h1><a href="{{ route('add_product_path') }}" class="pull-right btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add</a></h1>
                <h1 class="page-header">List of Products</h1>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    List of all the products
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $index => $product)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img src="img/products/{{ $product->image }}" alt="{{ $product->slug }}" style="width:100px;height: 50px;">
                                </td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->category->category_name }}</td>
                                <td>
                                    <a href="{{ route('edit_product', $product->slug) }}" class="btn btn-primary btn-xs">
                                        <span class="glyphicon glyphicon-edit"></span> Edit</a>
                                    {!! delete_form(['delete_product', $product->slug]) !!}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection