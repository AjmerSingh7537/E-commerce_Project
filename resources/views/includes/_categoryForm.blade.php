<div class="form-group">
    {!! Form::label('category_name', 'Category Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('category_name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
    </div>
</div>