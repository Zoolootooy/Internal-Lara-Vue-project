{!! Form::errorList($errors) !!}

{!! Form::textSlugField('full_name', $model->full_name) !!}

{!! Form::textSlugField('email', $model->email) !!}

{!! Form::textSlugField('phone', $model->phone) !!}

{!! Form::textSlugField('address', $model->address) !!}

{!! Form::textSlugField('extern_cards_list', $model->extern_cards_list) !!}

{!! Form::selectField('status', $model::status()) !!}

{!! Form::buttons('order.index') !!}

