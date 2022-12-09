{!! Form::errorList($errors) !!}

{!! Form::textField('title') !!}

{!! Form::textField('key') !!}

{!! Form::textField('value') !!}

{!! Form::selectField('value_type', $model::valueTypes()) !!}

{!! Form::buttons('setting.index') !!}