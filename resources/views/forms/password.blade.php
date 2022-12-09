@php ($options = FormHelper::options($field, $errors, $options, $singlePage ?? false, $filter ?? false))

@include('forms.component', [
    'component' => Form::password($field, $options)
])