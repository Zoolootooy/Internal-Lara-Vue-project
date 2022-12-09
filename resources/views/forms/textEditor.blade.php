@component('forms.textArea', [
    'field' => $field,
    'editor' => true,
    'options' => $options ?? [],
    'fullScreen' => $fullScreen ?? false,
    'label' => $label ?? null,
])
@endcomponent