{!! Form::openFilter(['route' => ['faqItem.index'], 'method' => 'get']) !!}
    <div class="row mt-2 mb-3">
        {!! Form::selectFieldFl('parent_id', $categories, __('Category')) !!}
        {!! Form::textFieldFl('name', __('Question')) !!}
        {!! Form::textFieldFl('description') !!}
        {!! Form::selectFieldFl('visible', $filters::visibleStatuses()) !!}
        {!! Form::filterButtons('faqItem.index') !!}
    </div>
{!! Form::close() !!}