@extends('layouts.blank')

@section('title', 'Register')

@section('content')
    <div class="bg-soft-primary">
        <div class="row">
            <div class="col-9">
                <div class="text-primary p-4">
                    <h5 class="text-primary">{{ __('Register') }}</h5>
                    <span>{{ __('Sign up to continue') }}</span>
                </div>
            </div>
            <div class="col-3 pt-3">
                <img src="/images/icons/profile.png" alt="" class="img-fluid" />
            </div>
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="p-2 pt-4">
            {!! Form::open(['route' => ['register']]) !!}

                {!! Form::textFieldFs('username', null, ['placeholder' => __('Username'), 'required', 'autocomplete' => 'username', 'autofocus']) !!}

                {!! Form::emailFieldFs('email', null, ['placeholder' => __('E-Mail Address'), 'required', 'autocomplete' => 'email']) !!}

                {!! Form::passwordFieldFs('password', null, ['placeholder' => __('Password'), 'required', 'autocomplete' => 'new-password']) !!}

                {!! Form::passwordFieldFs('password_confirmation', __('Confirm Password'), ['placeholder' => __('Confirm Password'), 'required', 'autocomplete' => 'new-password']) !!}

                <div class="mt-4">
                    {!! Form::submit(__('Register'), ['class' => 'btn btn-primary btn-block waves-effect waves-light']) !!}
                </div>
            {!! Form::close() !!}
            <div class="mt-4 text-center">
                <a href="{{ route('login') }}" class="text-muted"><i class="mdi mdi-face-profile mr-1"></i> {{ __('Login User') }}</a>
            </div>
        </div>
    </div>
@endsection
