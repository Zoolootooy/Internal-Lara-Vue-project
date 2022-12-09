{!! Form::errorList($errors) !!}

{!! Form::imageField('image', $model->getUrls('image'), $model->entryTitle) !!}

{!! Form::selectField('parent_id', $categories, __('Category')) !!}

<slug inline-template :value="'{{ old('slug', $model->slug) }}'">
    <div>
        {!! Form::textSlugField('link_name', $model->link_name) !!}

        {!! Form::textSlugField('slug', $model->slug, null, [':value' => 'slug']) !!}
    </div>
</slug>

{!! Form::textField('title') !!}

{!! Form::textField('meta_keywords') !!}

{!! Form::textField('meta_description') !!}

{!! Form::textField('header') !!}

{!! Form::selectField('visible', $model::visibleStatuses()) !!}

{!! Form::textFullEditorField('content') !!}

{!! Form::buttons('page.index') !!}
