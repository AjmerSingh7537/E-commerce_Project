@extends('admin.master')

@section('content')
    <div class="container-fluid">
        <div class="row" style="margin-top: 50px;">
            <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">Add Category</div>
                    <div class="panel-body">
                        @include('includes._errorMessages')
                        {!! Form::open(['route' => 'add_category', 'class' => 'form-horizontal', 'id' => 'add_category']) !!}
                            @include('includes._categoryForm')
                        {!! Form::close() !!}

                        <h2>All Categories</h2>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $index => $category)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>
                                    {!! delete_form(['delete_category', $category->id]) !!}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection