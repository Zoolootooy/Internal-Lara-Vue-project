@extends('layouts.frontend')

@section('title', 'Verify')

@section('content')
    <div class="container mt-5 mb-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card overflow-hidden">
                    <div class="bg-soft-primary">
                        <div class="row">
                            <div class="col-9">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">{{ __('Verify Account') }}</h5>
                                    <span>{{ __('Verify Your Email Address') }}</span>
                                </div>
                            </div>
                            <div class="col-3 pt-3">
                                <img src="/images/icons/profile.png" alt="" class="img-fluid" />
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="p-2 pt-4">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                            {!! Form::open(['route' => ['verification.resend'], 'class' => 'd-inline']) !!}
                                {!! Form::submit(__('click here to request another'), ['class' => 'btn btn-link p-0 m-0 align-baseline']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
