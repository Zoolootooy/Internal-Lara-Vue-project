@php ($htmlOptions = ['id' => $field, '@change' => 'change($event)'])
@php ($options = FormHelper::options($field, $errors, $options, $singlePage ?? false, $filter ?? false))

@component('forms.text', [
    'field' => $field,
    'options' => array_merge($options, $htmlOptions),
    'fullScreen' => $fullScreen ?? false,
    'label' => $label ?? null,
])
@endcomponent