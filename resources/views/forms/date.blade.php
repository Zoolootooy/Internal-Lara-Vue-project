@php ($cssClass = 'form-control form-control-date')
@php ($options['autocomplete'] = 'off')
@php ($options = FormHelper::options($field, $errors, $options, $singlePage ?? false, $filter ?? false, $cssClass))

@include('forms.component', [
    'component' => Form::text($field, FormHelper::value($options), $options)
])