{!! Form::errorList($errors) !!}

{!! Form::imageField('image', $model->getUrls('image'), $model->entryTitle) !!}

{!! Form::textField('name') !!}

{!! Form::selectField('visible', $model::visibleStatuses()) !!}

{!! Form::textEditorField('description') !!}

{!! Form::buttons('quote.index') !!}