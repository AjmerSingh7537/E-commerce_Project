<div class="form-group">
    {!! Form::label('product_name', 'Product Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('product_name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('description', 'Description', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('price', 'Price', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('price', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('slug', 'Slug', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('image', 'Image', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::file('image', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
    </div>
</div>