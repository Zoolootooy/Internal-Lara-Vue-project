{!! Form::errorList($errors) !!}

{!! Form::imageField('avatar', $model->getUrls('avatar'), $model->entryTitle) !!}

{!! Form::textField('username') !!}

{!! Form::emailField('email') !!}

{!! Form::textField('first_name') !!}

{!! Form::textField('last_name') !!}

@if (empty($model->id))
    {!! Form::passwordField('password') !!}
@endif

{!! Form::dateField('birthday') !!}

{!! Form::selectField('country_id', $countries, __('Country')) !!}

{!! Form::textField('zip') !!}

{!! Form::textField('city') !!}

{!! Form::textField('address') !!}

{!! Form::textField('phone') !!}

@php ($genders = $model::genders())
@php (array_shift($genders))

{!! Form::selectField('gender', $genders) !!}

{!! Form::selectField('status', $model::statuses()) !!}

<div class="form-group row">
    {!! Form::label('roles', null, ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-10">
        @foreach ($roles as $role)
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('roles[]', $role->id, $model->hasRole($role->name)) !!}
                    {{ $role->name }}
                </label>
            </div>
        @endforeach
    </div>
</div>

{!! Form::buttons('user.index') !!}