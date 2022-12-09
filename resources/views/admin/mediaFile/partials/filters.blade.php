{!! Form::openFilter(['route' => ['mediaFile.index'], 'method' => 'get']) !!}
    <div class="row mt-2 mb-3">
        {!! Form::selectFieldFl('parent_id', $categories, __('Category')) !!}
        {!! Form::textFieldFl('name') !!}
        {!! Form::selectFieldFl('visible', $filters::visibleStatuses()) !!}
        {!! Form::filterButtons('mediaFile.index') !!}
    </div>
{!! Form::close() !!}