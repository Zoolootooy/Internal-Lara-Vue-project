@php ($options = FormHelper::options($field, $errors, $options, $singlePage ?? false, $filter ?? false, 'custom-control-input'))

<div class="custom-control custom-checkbox">
    {!! Form::checkbox($field, FormHelper::value($options), old($field), $options) !!}
    {!! Form::label($field, $label ?? null, ['class' => 'custom-control-label']) !!}
    <div>
        {!! Form::error($field, $options, $singlePage ?? false) !!}
    </div>
</div>