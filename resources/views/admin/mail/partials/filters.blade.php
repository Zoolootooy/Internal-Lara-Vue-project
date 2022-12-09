{!! Form::openFilter(['route' => ['mail.index'], 'method' => 'get']) !!}
    <div class="row mt-2 mb-3">
        {!! Form::textFieldFl('sender_email') !!}
        {!! Form::textFieldFl('sender_name') !!}
        {!! Form::textFieldFl('subject') !!}
        {!! Form::textFieldFl('body') !!}
        {!! Form::selectFieldFl('opened', $filters::openedStatuses()) !!}
        {!! Form::filterButtons('mail.index') !!}
    </div>
{!! Form::close() !!}