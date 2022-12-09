{!! Form::openFilter(['route' => ['snippet.index'], 'method' => 'get']) !!}
    <div class="row mt-2 mb-3">
        {!! Form::textFieldFl('name') !!}
        {!! Form::selectFieldFl('location', $filters::locations()) !!}
        {!! Form::selectFieldFl('visible', $filters::visibleStatuses()) !!}
        {!! Form::filterButtons('snippet.index') !!}
    </div>
{!! Form::close() !!}