{!! Form::errorList($errors) !!}

{!! Form::emailField('sender_email') !!}

{!! Form::textField('sender_name') !!}

{!! Form::textField('subject') !!}

{!! Form::textAreaField('body') !!}

{!! Form::selectField('opened', $model::openedStatuses()) !!}

{!! Form::buttons('mail.index') !!}
