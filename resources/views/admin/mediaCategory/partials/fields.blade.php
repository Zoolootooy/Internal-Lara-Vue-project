{!! Form::errorList($errors) !!}

<slug inline-template :value="'{{ old('slug', $model->slug) }}'">
    <div>
        {!! Form::textSlugField('name', $model->name) !!}

        {!! Form::textSlugField('slug', $model->slug, null, [':value' => 'slug']) !!}
    </div>
</slug>

{!! Form::textAreaField('description') !!}

{!! Form::selectField('visible', $model::visibleStatuses()) !!}

{!! Form::buttons('mediaCategory.index') !!}