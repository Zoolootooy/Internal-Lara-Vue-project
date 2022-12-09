{!! Form::openFilter(['route' => ['user.index'], 'method' => 'get']) !!}
    <div class="row mt-2 mb-3">
        {!! Form::textFieldFl('username') !!}
        {!! Form::emailFieldFl('email') !!}
        {!! Form::selectFieldFl('country_id', $countries, __('Country')) !!}
        {!! Form::textFieldFl('address') !!}
        {!! Form::selectFieldFl('status', $filters::statuses()) !!}
        {!! Form::dateFieldFl('from_created_at', __('Registration From')) !!}
        {!! Form::dateFieldFl('to_created_at', __('Registration To')) !!}
        {!! Form::filterButtons('user.index') !!}
    </div>
{!! Form::close() !!}