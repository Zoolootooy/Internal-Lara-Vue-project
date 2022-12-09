{!! Form::errorList($errors) !!}

@if (!$model->exists)
    {!! Form::selectField('group', $model::groups()) !!}

    {!! Form::textAreaField('key') !!}
@else
    <div class="form-group row">
        <label class="col-md-2">{{ __('Group') }}</label>
        <div class="col-md-10 text-muted">
            {{ $model->group }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-2">{{ __('Key') }}</label>
        <div class="col-md-10 text-muted">
            {{ $model->key }}
        </div>
    </div>
@endif

@foreach ($model::languages() as $language)
    {!! Form::textAreaField($language,
        ucfirst($language) . ' ' . __('Translation'),
        ['value' => optional($model->$language)->value ?? '']
    ) !!}
@endforeach

<div class="form-group row">
    <label class="col-md-2">{{ __('Published') }}</label>
    <div class="col-md-10 text-muted">
        <span class="badge badge-{{ $model->publishedBadgeClass }}">{{ $model->publishedText }}</span>
    </div>
</div>

{!! Form::buttons('translation.index') !!}