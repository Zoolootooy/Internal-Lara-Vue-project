@php ($options['rows'] = $options['rows'] ?? 4)
@php ($class = 'form-control'
    . (!empty($editor) ? ' form-control-editor' : null)
    . (!empty($fullEditor) ? ' form-control-full-editor' : null))
@php ($options = FormHelper::options($field, $errors, $options, $singlePage ?? false, $filter ?? false, $class))

@include('forms.component', [
    'component' => Form::textarea($field, FormHelper::value($options), $options)
])