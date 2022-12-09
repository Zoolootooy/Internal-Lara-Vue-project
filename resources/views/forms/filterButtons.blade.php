<div class="col-xl col-sm-4">
    <div class="form-group">
        <label class="col-md-12 col-form-label">&nbsp;</label>
        {!! Form::submit(__('Filter'), ['class' => 'btn btn-primary']) !!}&nbsp;
        <a href="{{ route($cancelUri, ['clear' => true]) }}" class="btn btn-secondary">{{ __('Clear') }}</a>
    </div>
</div>