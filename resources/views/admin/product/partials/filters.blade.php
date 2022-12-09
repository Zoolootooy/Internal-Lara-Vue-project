{!! Form::openFilter(['route' => ['order.index'], 'method' => 'get']) !!}
<div class="row mt-2 mb-3">
    {!! Form::textFieldFl('full_name') !!}
    {!! Form::textFieldFl('phone') !!}
    {!! Form::filterButtons('order.index') !!}
</div>
{!! Form::close() !!}
