{!! Form::openFilter(['route' => ['translation.index'], 'method' => 'get']) !!}
    <div class="row mt-2 mb-3">
        {!! Form::selectFieldFl('status', $filters::statuses()) !!}
        {!! Form::textFieldFl('locale') !!}
        {!! Form::textFieldFl('group') !!}
        {!! Form::textFieldFl('key') !!}
        {!! Form::textFieldFl('value') !!}
        {!! Form::filterButtons('translation.index') !!}
    </div>
{!! Form::close() !!}