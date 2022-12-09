@php ($options = FormHelper::options($field, $errors, $options, $singlePage ?? false, $filter ?? false))

@include('forms.component', [
    'component' => Form::email($field, FormHelper::value($options), $options)
])
