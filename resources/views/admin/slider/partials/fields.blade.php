{!! Form::errorList($errors) !!}

{!! Form::imageField('image', $model->getUrls('image'), $model->entryTitle) !!}

{!! Form::textField('name') !!}

{!! Form::textEditorField('description') !!}

{!! Form::textField('video_url') !!}

{!! Form::textField('forward_url') !!}

{!! Form::selectField('type', $model::types()) !!}

{!! Form::selectField('position', $model::positions()) !!}

{!! Form::textField('button_caption') !!}

{!! Form::selectField('visible', $model::visibleStatuses()) !!}

{!! Form::buttons('slider.index') !!}