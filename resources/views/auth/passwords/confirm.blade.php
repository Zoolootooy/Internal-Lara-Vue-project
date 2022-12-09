@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirm Password') }}</div>

                <div class="card-body">
                    {{ __('Please confirm your password before continuing.') }}
                    {!! Form::open(['route' => ['password.confirm']]) !!}
                        {!! Form::passwordFieldFs('password', null, ['required', 'autocomplete' => 'current-password']) !!}
                        <div class="mt-3">
                            {!! Form::submit(__('Confirm Password'), ['class' => 'btn btn-primary']) !!}
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
