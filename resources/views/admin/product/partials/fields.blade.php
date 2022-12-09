{!! Form::errorList($errors) !!}

{!! Form::textSlugField('name', $model->name) !!}

{!! Form::textSlugField('price', $model->price) !!}

{!! Form::selectField('type', ['main', 'tag'], __('Type')) !!}

{!! Form::buttons('product.index') !!}
