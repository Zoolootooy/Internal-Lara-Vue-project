@component('forms.textArea', [
    'field' => $field,
    'fullEditor' => true,
    'options' => $options ?? [],
    'labelCols' => $labelCols ?? null,
    'label' => $label ?? null,
])
@endcomponent