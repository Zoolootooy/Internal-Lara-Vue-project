@php ($options = FormHelper::options($field, $errors, $options, $singlePage ?? false, $filter ?? false))

@include('forms.component', [
    'component' => Form::text($field, FormHelper::value($options), $options)
])