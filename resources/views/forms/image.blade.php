@php ($options = FormHelper::options($field, $errors, $options, $singlePage ?? false, $filter ?? false, 'form-control-file'))
@php ($fullScreen = $fullScreen ?? false)

@if ($urls->file)
    <div class="form-group row">
        <div class="@if (!$fullScreen) offset-2 @endif col-md-10">
            <a href="{{ $urls->file }}" target="_blank">
                <img class="img-thumbnail avatar" src="{{ $urls->thumbnail }}" alt="{{ $entryTitle }}" width="150" />
            </a>
        </div>
    </div>
@endif

@include('forms.component', [
    'component' => Form::file($field, $options)
])