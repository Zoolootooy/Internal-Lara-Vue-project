@extends('layouts.blank')

@section('title', 'Reset Password')

@section('content')
    <div class="bg-soft-primary">
        <div class="row">
            <div class="col-9">
                <div class="text-primary p-4">
                    <h5 class="text-primary">{{ __('Reset Password') }}</h5>
                    <span>{{ __('Reset to continue') }}</span>
                </div>
            </div>
            <div class="col-3 pt-3">
                <img src="/images/icons/profile.png" alt="" class="img-fluid" />
            </div>
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="p-2 pt-4">

            {!! Form::open(['route' => ['password.update']]) !!}

                {{ Form::hidden('token', $token) }}

                {!! Form::emailFieldFs('email', __('E-Mail Address'), ['value' => $email ?? old('email'), 'placeholder' => __('E-Mail Address'), 'required', 'autocomplete' => 'email', 'autofocus']) !!}

                {!! Form::passwordFieldFs('password', null, ['placeholder' => __('Password'), 'required', 'autocomplete' => 'new-password']) !!}

                {!! Form::passwordFieldFs('password_confirmation', __('Confirm Password'), ['placeholder' => __('Confirm Password'), 'required', 'autocomplete' => 'new-password']) !!}

                <div class="mt-3">
                    {!! Form::submit(__('Reset Password'), ['class' => 'btn btn-primary btn-block waves-effect waves-light']) !!}
                </div>

            {!! Form::close() !!}

            <div class="mt-4 text-center">
                <a href="{{ route('login') }}" class="text-muted"><i class="mdi mdi-face-profile mr-1"></i> {{ __('Login User') }}</a>
            </div>
        </div>
    </div>
@endsection
