{!! Form::openFilter(['route' => ['unit.index'], 'method' => 'get']) !!}
    <div class="row mt-2 mb-3">
        {!! Form::textFieldFl('name') !!}
        {!! Form::selectFieldFl('parent_id', $units, __('Parent')) !!}
        {!! Form::selectFieldFl('visible', $filters::visibleStatuses()) !!}
        {!! Form::filterButtons('unit.index') !!}
    </div>
{!! Form::close() !!}