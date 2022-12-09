{!! Form::errorList($errors) !!}

{!! Form::selectField('type', $model::types()) !!}

<slug inline-template :value="'{{ old('slug', $model->slug) }}'">
    <div>
        {!! Form::textSlugField('name', $model->name) !!}

        {!! Form::textSlugField('slug', $model->slug, null, [':value' => 'slug']) !!}
    </div>
</slug>

{!! Form::buttons('menu.index') !!}