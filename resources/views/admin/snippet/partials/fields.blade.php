{!! Form::errorList($errors) !!}

<slug inline-template :value="'{{ old('slug', $model->slug) }}'">
    <div>
        {!! Form::textSlugField('name', $model->name) !!}

        {!! Form::textSlugField('slug', $model->slug, null, [':value' => 'slug']) !!}
    </div>
</slug>

{!! Form::textAreaField('content') !!}

{!! Form::selectField('location', $model::locations()) !!}

{!! Form::selectField('visible', $model::visibleStatuses()) !!}

<div class="form-group row">
    {!! Form::label('pages', null, ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-10">
        @foreach ($pages as $page)
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('pages[]', $page->id, $model->hasPage($page->id)) !!}
                    {{ $page->link_name }}
                </label>
            </div>
        @endforeach
    </div>
</div>

{!! Form::buttons('snippet.index') !!}