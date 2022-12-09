@extends('layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => ['user.updatePassword', $model->id], 'files' => true]) !!}
                        @method('PUT')

                        {!! Form::errorList($errors) !!}

                        {!! Form::passwordField('new_password', null, ['isRequired' => true]) !!}

                        {!! Form::passwordField('confirm_password', null, ['isRequired' => true]) !!}

                        {!! Form::buttons('user.index') !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        @include('admin.user.partials.statistics')

    </div>
@endsection