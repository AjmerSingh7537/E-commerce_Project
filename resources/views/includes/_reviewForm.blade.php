<div class="form-group">
    {!! Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5', 'cols' => '10','placeholder' => 'Enter your review here...', 'id' => 'comment']) !!}
</div>
<div class="form-group">
    <div class="pull-left">
        {!! Form::input('hidden', 'ratings', null, ['id' => 'product_rating']) !!}
        {!! Form::input('hidden', 'product_slug', $product->slug) !!}
        {!! Form::input('number', 'rating-input', '0', [
        'class' => 'rating',
        'id' => 'rating-input',
        'min' => '0', 'max' => '5', 'step' => '0.5', 'data-size' => 'xs'])
        !!}
    </div>
    <div class="pull-right">
        {!! Form::submit('Submit', ['class' => 'btn btn-success pull-right', 'id' => 'submit_button']) !!}
    </div>
</div>