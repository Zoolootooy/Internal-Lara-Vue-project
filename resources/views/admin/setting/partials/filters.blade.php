{!! Form::openFilter(['route' => ['setting.index'], 'method' => 'get']) !!}
    <div class="row mt-2 mb-3">
        {!! Form::textFieldFl('title') !!}
        {!! Form::textFieldFl('key') !!}
        {!! Form::textFieldFl('value') !!}
        {!! Form::selectFieldFl('type', $filters::types()) !!}
        {!! Form::selectFieldFl('value_type', $filters::valueTypes()) !!}
        {!! Form::filterButtons('setting.index') !!}
    </div>
{!! Form::close() !!}