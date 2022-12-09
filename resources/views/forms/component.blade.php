@php ($fullScreen = $fullScreen ?? false)
@php ($labelCols = $fullScreen ? 12 : 2)
@php ($fieldCols = $fullScreen ? 12 : 10)
@php ($filter = $filter ?? false)
@php ($label = $label ?? __(ucwords(str_replace('_', ' ', $field))))
@php ($addAsterisk = !$filter && (RuleHelper::isRequired($field) || !empty($options['required']) || !empty($options['isRequired'])))
@php ($asterisk = $addAsterisk ? '&nbsp;<span class="text-danger">*</span>' : null)

@if ($filter) <div class="col-xl col-sm-4"> @endif

<div class="form-group row">
    {!! Form::label($field, $label . $asterisk, ['class' => 'col-md-' . $labelCols . ' col-form-label'], false) !!}
    <div class="col-md-{{ $fieldCols }}">
        {!! $component !!}
        {!! Form::error($field, $options, $singlePage ?? false) !!}
    </div>
</div>

@if ($filter) </div> @endif
