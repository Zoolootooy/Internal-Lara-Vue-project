@extends('layouts.backend')

@section('content')

    <div class="row">
        @foreach ($icons as $icon)
            @component('components.card', ['item' => $icon['item'], 'author' => $author, 'manager' => $manager])
            @endcomponent
        @endforeach
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6 mt-2">
                    <h3 class="card-title">{{ __('Users') }}</h3>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('user.create') }}" class="btn btn-success btn-rounded">
                        <i class="mdi mdi-plus"></i>
                        {{ __('Add User') }}
                    </a>
                    <a href="{{ route('user.index') }}" class="btn btn-primary btn-rounded">
                        {{ __('All Users') }}
                        <i class="mdi mdi-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>

            <div class="table-wrapper">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Avatar') }}</th>
                        <th>{{ __('Username') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Roles') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th class="secondary">{{ __('Registered') }}</th>
                        <th class="secondary">{{ __('Last Login') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    @forelse ($users as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>
                                @component('components.image', ['model' => $model, 'field' => 'avatar']) @endcomponent
                            </td>
                            <td>{{ $model->username }}</td>
                            <td>{{ $model->email }}</td>
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
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6 mt-2">
                    <h3 class="card-title">{{ __('Pages') }}</h3>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('page.create') }}" class="btn btn-success btn-rounded">
                        <i class="mdi mdi-plus"></i>
                        {{ __('Add Page') }}
                    </a>
                    <a href="{{ route('page.index') }}" class="btn btn-primary btn-rounded">
                        {{ __('All Pages') }}
                        <i class="mdi mdi-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>

            <div class="table-wrapper">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Link Name') }}</th>
                        <th>{{ __('Slug') }}</th>
                        <th>{{ __('Category') }}</th>
                        <th>{{ __('Content') }}</th>
                        <th>{{ __('Visible') }}</th>
                        <th class="secondary">{{ __('Created By') }}</th>
                        <th class="secondary">{{ __('Created At') }}</th>
                        <th class="secondary">{{ __('Updated At') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    @forelse ($pages as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->link_name }}</td>
                            <td>{{ $model->slug }}</td>
                            <td>{{ optional($model->category)->name }}</td>
                            <td>{{ Str::limit(strip_tags($model->content), 50) }}</td>
                            <td>
                                <span class="badge badge-{{ $model->visibleBadgeClass }}">{{ $model->visibleText }}</span>
                            </td>
                            <td class="secondary">{{ $model->createdByText }}</td>
                            <td class="secondary">{{ $model->createdDate }}</td>
                            <td class="secondary">{{ $model->updatedDate }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('page.edit', ['page' => $model->id]) }}" title="{{ __('Edit') }}" class="btn btn-primary btn-sm fa fa-pencil"></a>
                                <a href="{{ route('page.destroy', ['page' => $model->id]) }}" title="{{ __('Delete') }}" class="btn btn-danger btn-sm fa fa-trash" @click="confirmDelete($event)"></a>
                            </td>
                        </tr>
                    @empty
                        @include('admin.partials.noRecord')
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
