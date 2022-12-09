{!! Form::openFilter(['route' => ['slider.index'], 'method' => 'get']) !!}
    <div class="row mt-2 mb-3">
        {!! Form::textFieldFl('name') !!}
        {!! Form::textFieldFl('description') !!}
        {!! Form::textFieldFl('video_url') !!}
        {!! Form::selectFieldFl('type', $filters::types()) !!}
        {!! Form::selectFieldFl('position', $filters::positions()) !!}
        {!! Form::selectFieldFl('visible', $filters::visibleStatuses()) !!}
        {!! Form::filterButtons('slider.index') !!}
    </div>
{!! Form::close() !!}