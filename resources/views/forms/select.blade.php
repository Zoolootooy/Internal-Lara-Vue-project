@php ($options = FormHelper::options($field, $errors, $options, $singlePage ?? false, $filter ?? false))
@php ($options['placeholder'] = '')

@include('forms.component', [
    'component' => Form::select($field, $selectOptions, FormHelper::value($options), $options)
])
