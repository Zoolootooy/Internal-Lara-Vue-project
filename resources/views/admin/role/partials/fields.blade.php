{!! Form::errorList($errors) !!}

{!! Form::textField('name') !!}

{!! Form::selectField('type', $model::types()) !!}

@if (count($permissions) > 0)
    <div class="form-group row">
        {!! Form::label('permissions', null, ['class' => 'col-md-2 col-form-label']) !!}
        <div class="col-md-10">
            @if ($model->name != App\Models\Role::ROLE_SUPER_ADMIN)
                @foreach ($permissions as $permission)
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox(
                                'permissions[]',
                                $permission->id,
                                $model->hasPermission($permission->unit_id, $permission->action)
                            ) !!}
                            {{ $permission->name }}
                        </label>
                    </div>
                @endforeach
            @else
                {!! Form::text(null, __('Full Super Admin Access'), ['class' => 'form-control', 'disabled']) !!}
            @endif
        </div>
    </div>
@endif

{!! Form::buttons('role.index') !!}
