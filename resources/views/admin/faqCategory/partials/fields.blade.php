{!! Form::errorList($errors) !!}

<slug inline-template :value="'{{ old('slug', $model->slug) }}'">
    <div>
        {!! Form::textSlugField('name', $model->name) !!}

        {!! Form::textSlugField('slug', $model->slug, null, [':value' => 'slug']) !!}
    </div>
</slug>

{!! Form::textField('keywords') !!}

{!! Form::selectField('visible', $model::visibleStatuses()) !!}

{!! Form::buttons('faqCategory.index') !!}
