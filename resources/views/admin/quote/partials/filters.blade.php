{!! Form::openFilter(['route' => ['quote.index'], 'method' => 'get']) !!}
    <div class="row mt-2 mb-3">
        {!! Form::textFieldFl('name') !!}
        {!! Form::textFieldFl('description') !!}
        {!! Form::selectFieldFl('visible', $filters::visibleStatuses()) !!}
        {!! Form::filterButtons('quote.index') !!}
    </div>
{!! Form::close() !!}