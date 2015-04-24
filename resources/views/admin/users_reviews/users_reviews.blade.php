@extends('admin/master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="caption">
                <h1 class="page-header">Users' Reviews</h1>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12" style="min-width: 640px;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    List of all the users' reviews
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="users_reviews">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Product Name</th>
                                <th>Comment</th>
                                <th>Stars</th>
                                <th>Approved</th>
                                <th>Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reviews as $index => $review)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ ucfirst($review->user->name) }}</td>
                                    <td>{{ $review->product->product_name }}</td>
                                    <td>{{ $review->comment }}</td>
                                    <td>{{ $review->ratings }}</td>
                                    <td>
                                        {!! Form::input('number', 'approved', $review->approved,
                                        ['class' => 'form-control text-center', 'min' => 0, 'max' => 1, 'style' => 'width: 40px;']) !!}
                                    </td>
                                    <td>
                                        {!! delete_form(['delete_review', $review->id]) !!}
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
@stop