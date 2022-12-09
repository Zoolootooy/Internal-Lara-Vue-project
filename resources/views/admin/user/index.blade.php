@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6 mt-2">
                    <h3 class="card-title">{{ __('All Users') }}</h3>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('user.create') }}" class="btn btn-success btn-rounded">
                        <i class="mdi mdi-plus"></i>
                        {{ __('Add User') }}
                    </a>
                </div>
            </div>
            @include('admin.user.partials.filters')
            <div class="table-wrapper">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Avatar') }}</th>
                        <th>{{ __('Username') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Full Name') }}</th>
                        <th>{{ __('Roles') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th class="secondary">{{ __('Registered') }}</th>
                        <th class="secondary">{{ __('Last Login') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    @forelse ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>
                                @component('components.image', ['model' => $model, 'field' => 'avatar']) @endcomponent
                            </td>
                            <td>{{ $model->username }}</td>
                            <td>{{ $model->email }}</td>
                            <td>{{ $model->full_name }}</td>
                            <td>{{ $model->rolesText }}</td>
                            <td>
                                <span class="badge badge-{{ $model->statusBadgeClass }}">{{ $model->statusText }}</span>
                            </td>
                            <td class="secondary">{{ $model->createdDate }}</td>
                            <td class="secondary">{{ $model->lastLoginDate }} {{ $model->lastLoginTime }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('user.edit', ['user' => $model->id]) }}" title="{{ __('Edit') }}"  class="btn btn-primary btn-sm fa fa-pencil"></a>
                                <a href="{{ route('user.password', ['user' => $model->id]) }}" title="{{ __('Change Password') }}"  class="btn btn-success btn-sm fa fa-key"></a>
                                <a href="{{ route('user.destroy', ['user' => $model->id]) }}" title="{{ __('Delete') }}" class="btn btn-danger btn-sm fa fa-trash" @click="confirmDelete($event)"></a>
                            </td>
                        </tr>
                    @empty
                        @include('admin.partials.noRecord')
                    @endforelse
                </table>
                {{ $models->links() }}
            </div>
        </div>
    </div>
@endsection
