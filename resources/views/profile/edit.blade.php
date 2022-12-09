@extends('layouts.frontend')

@section('title', __('Edit Profile'))

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card overflow-hidden">
                    <div class="bg-soft-primary">
                        <div class="row">
                            <div class="col-9">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">{{ __('Edit Profile') }}</h5>
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

                            {!! Form::model($model, ['route' => ['profile.update'], 'files' => true]) !!}

                            @method('PUT')

                            {!! Form::errorList($errors) !!}

                            {!! Form::imageFieldFs('avatar', $model->getUrls('avatar'), $model->entryTitle) !!}

                            {!! Form::textFieldFs('username') !!}

                            {!! Form::emailFieldFs('email') !!}

                            {!! Form::dateFieldFs('birthday') !!}

                            {!! Form::selectFieldFs('country_id', $countries, __('Country')) !!}

                            {!! Form::textFieldFs('zip') !!}

                            {!! Form::textFieldFs('city') !!}

                            {!! Form::textFieldFs('address') !!}

                            {!! Form::textFieldFs('phone') !!}

                            {!! Form::selectFieldFs('gender', $model::genders()) !!}

                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('profile.index') }}" class="btn btn-secondary btn-block">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                                <div class="col-6">
                                    {!! Form::submit('Submit', ['class' => 'btn btn-primary btn-block']); !!}
                                </div>
                            </div>

                            {!! Form::close() !!}

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

