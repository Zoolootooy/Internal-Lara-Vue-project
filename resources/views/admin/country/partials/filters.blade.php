{!! Form::openFilter(['route' => ['country.index'], 'method' => 'get']) !!}
    <div class="row mt-2 mb-3">
        {!! Form::textFieldFl('name') !!}
        {!! Form::textFieldFl('phone_code') !!}
        {!! Form::filterButtons('country.index') !!}
    </div>
{!! Form::close() !!}