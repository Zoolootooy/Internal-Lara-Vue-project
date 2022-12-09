{!! Form::errorList($errors) !!}

{!! Form::selectField('parent_id', $units, __('Parent')) !!}

<slug inline-template :value="'{{ old('slug', $model->slug) }}'">
    <div>
        {!! Form::textSlugField('name', $model->name) !!}

        {!! Form::textSlugField('slug', $model->slug, null, [':value' => 'slug']) !!}
    </div>
</slug>

{!! Form::selectField('visible', $model::visibleStatuses()) !!}

{!! Form::buttons('unit.index') !!}