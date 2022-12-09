<div class="form-group row mb-0 text-right">
    <div class="col-md-10 offset-md-2">
        <a href="{{ route($cancelUri) }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
        {!! Form::submit(__('Submit'), ['class' => 'btn btn-primary']) !!}
    </div>
</div>
