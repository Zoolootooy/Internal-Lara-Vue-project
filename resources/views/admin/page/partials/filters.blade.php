{!! Form::openFilter(['route' => ['page.index'], 'method' => 'get']) !!}
    <div class="row mt-2 mb-3">
        {!! Form::selectFieldFl('parent_id', $categories, __('Category')) !!}
        {!! Form::textFieldFl('link_name') !!}
        {!! Form::textFieldFl('title') !!}
        {!! Form::textFieldFl('content') !!}
        {!! Form::textFieldFl('header') !!}
        {!! Form::selectFieldFl('visible', $filters::visibleStatuses()) !!}
        {!! Form::filterButtons('page.index') !!}
    </div>
{!! Form::close() !!}