{!! Form::errorList($errors) !!}

{!! Form::textField('title', 'Title', ['minlength' => 5, 'maxlength' => 50]) !!}

{!! Form::imageField('image', $model->getUrls('image'), $model->entryTitle) !!}

{!! Form::selectField('visible', $model::visibleStatuses()) !!}

{{--{!! Form::textField('short_description', 'Short Description', ['minlength' => 50, 'maxlength' => 500]) !!}--}}

{!! Form::textAreaField('description', 'Description', ['minlength' => 50, 'maxlength' => 500]) !!}

{!! Form::buttons('article.index') !!}
