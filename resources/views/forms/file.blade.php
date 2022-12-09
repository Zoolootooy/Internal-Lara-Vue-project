@php ($options = FormHelper::options($field, $errors, $options, $singlePage ?? false, $filter ?? false, 'form-control-file'))

@if ($urls->file)
    <div class="form-group row">
        <div class="@if (!empty($labelCols)) offset-{{ $labelCols }} @endif col-md-10">
            <a href="{{ $urls->file }}" target="_blank">
                <img src="/images/file.png" alt="{{ $entryTitle }}" />
            </a>
        </div>
    </div>
@endif

@include('forms.component', [
    'component' => Form::file($field, $options)
])