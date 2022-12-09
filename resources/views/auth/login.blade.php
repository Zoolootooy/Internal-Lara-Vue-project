@extends('layouts.blank')

@section('title', 'Login')

@section('content')
    <div class="bg-soft-primary">
        <div class="row">
            <div class="col-9">
                <div class="text-primary p-4">
                    <h5 class="text-primary">{{ __('Login') }}</h5>
                    <span>{{ __('Sign in to continue') }}</span>
                </div>
            </div>
            <div class="col-3 pt-3">
                <img src="/images/icons/profile.png" alt="" class="img-fluid" />
            </div>
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="p-2 pt-4">
            {!! Form::open(['route' => ['login']]) !!}

                {!! Form::emailFieldFs('email', __('E-Mail Address'), ['placeholder' => __('E-Mail Address'), 'required', 'autocomplete' => 'email', 'autofocus']) !!}

                {!! Form::passwordFieldFs('password', __('Password'), ['placeholder' => __('Password'), 'required', 'autocomplete' => 'current-password']) !!}

                {!! Form::checkboxField('remember', __('Remember Me')) !!}

                <div class="mt-3">
                    {!! Form::submit(__('Login'), ['class' => 'btn btn-primary btn-block waves-effect waves-light']) !!}
                </div>
            {!! Form::close() !!}
            <div class="mt-4 text-center clearfix">
                <a href="{{ route('register') }}" class="text-muted pull-left"><i class="mdi mdi-face-profile mr-1"></i> {{ __('Register User') }}</a>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-muted  pull-right"><i class="mdi mdi-lock mr-1"></i> {{ __('Forgot Your Password?') }}</a>
                @endif
            </div>
            <!--div class="mt-4">
                <a href="{{ route('login.facebook') }}" title="{{ __('Facebook') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-facebook"></i> {{ __('Facebook') }}
                </a>
                <a href="{{ route('login.facebook') }}" title="{{ __('Twitter') }}" class="btn btn-sm btn-info">
                    <i class="fa fa-twitter"></i> {{ __('Twitter') }}
                </a>
                <a href="{{ route('login.facebook') }}" title="{{ __('LinkedIn') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-linkedin"></i> {{ __('LinkedIn') }}
                </a>
                <a href="{{ route('login.facebook') }}" title="{{ __('Google') }}" class="btn btn-sm btn-danger">
                    <i class="fa fa-google"></i> {{ __('Google') }}
                </a>
                <a href="{{ route('login.facebook') }}" title="{{ __('GitHub') }}" class="btn btn-sm btn-success">
                    <i class="fa fa-github"></i> {{ __('GitHub') }}
                </a>
            </div-->
        </div>
    </div>
@endsection
