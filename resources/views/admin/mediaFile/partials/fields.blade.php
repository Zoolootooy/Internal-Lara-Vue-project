{!! Form::errorList($errors) !!}

{!! Form::imageField('file', $model->getUrls('file'), $model->entryTitle) !!}

{!! Form::selectField('parent_id', $categories, __('Category')) !!}

{!! Form::textField('name') !!}

{!! Form::selectField('visible', $model::visibleStatuses()) !!}

{!! Form::buttons('mediaFile.index') !!}
