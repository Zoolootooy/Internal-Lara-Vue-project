@extends('layouts.frontend')

@section('title', __('My Profile'))

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card overflow-hidden">
                    <div class="bg-soft-primary">
                        <div class="row">
                            <div class="col-9">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">{{ __('My Profile') }}</h5>
                                    <span>{{ __('Personal user information') }}</span>
                                </div>
                            </div>
                            <div class="col-3 pt-3">
                                <img src="/images/icons/profile.png" alt="" class="img-fluid" />
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="p-2 pt-4">
                            @if ($model->avatar)
                                <div class="form-group">
                                    <img class="img-thumbnail avatar" src="{{ $model->getThumbnailUrl('avatar') }}" alt="{{ $model->username }}" width="150" />
                                </div>
                            @endif
                            @if ($model->username)
                                <div class="form-group">
                                    <b>{{ __('Username') }}:</b>
                                    {{ $model->username }}
                                </div>
                            @endif
                            @if ($model->email)
                                <div class="form-group">
                                    <b>{{ __('Email') }}:</b>
                                    {{ $model->email }}
                                </div>
                            @endif
                            @if ($model->birthday)
                                <div class="form-group" style="position: relative">
                                    <b>{{ __('Birthday') }}:</b>
                                    {{ $model->birthdayDate }}
                                </div>
                            @endif
                            @if ($model->country_id)
                                <div class="form-group">
                                    <b>{{ __('Country') }}:</b>
                                    {{ $model->country->name }}
                                </div>
                            @endif
                            @if ($model->zip)
                                <div class="form-group">
                                    <b>{{ __('Zip') }}:</b>
                                    {{ $model->zip }}
                                </div>
                            @endif
                            @if ($model->city)
                                <div class="form-group">
                                    <b>{{ __('City') }}:</b>
                                    {{ $model->city }}
                                </div>
                            @endif
                            @if ($model->address)
                                <div class="form-group">
                                    <b>{{ __('Address') }}:</b>
                                    {{ $model->address }}
                                </div>
                            @endif
                            @if ($model->phone)
                                <div class="form-group">
                                    <b>{{ __('Phone') }}:</b>
                                    {{ $model->phone }}
                                </div>
                            @endif
                            @if ($model->phone)
                                <div class="form-group">
                                    <b>{{ __('Gender') }}:</b>
                                    {{ $model->genderText }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('profile.password') }}" class="btn btn-secondary btn-block">
                                        {{ __('Reset Password') }}
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-block">
                                        <i class="fa fa-pencil"></i>&nbsp;
                                        {{ __('Edit Profile') }}
                                    </a>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <a href="{{ route('logout') }}" class="text-muted logout-link">
                                    <i class="mdi mdi-face-profile mr-1"></i> {{ __('Logout User') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection