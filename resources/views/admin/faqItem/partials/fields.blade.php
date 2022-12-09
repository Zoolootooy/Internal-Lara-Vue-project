{!! Form::errorList($errors) !!}

{!! Form::selectField('parent_id', $categories, __('Category')) !!}

<slug inline-template :value="'{{ old('slug', $model->slug) }}'">
    <div>
        {!! Form::textSlugField('name', $model->name, __('Question')) !!}

        {!! Form::textSlugField('slug', $model->slug, null, [':value' => 'slug']) !!}
    </div>
</slug>

{!! Form::textEditorField('description') !!}

{!! Form::selectField('visible', $model::visibleStatuses()) !!}

{!! Form::buttons('faqItem.index') !!}