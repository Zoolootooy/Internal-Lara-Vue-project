@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6 mt-2">
                    <h3 class="card-title">{{ __('All Roles') }}</h3>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('role.create') }}" class="btn btn-success btn-rounded">
                        <i class="mdi mdi-plus"></i>
                        {{ __('Add Role') }}
                    </a>
                </div>
            </div>
            <div class="table-wrapper">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Type') }}</th>
                        <th class="secondary">{{ __('Created By') }}</th>
                        <th class="secondary">{{ __('Created At') }}</th>
                        <th class="secondary">{{ __('Updated At') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    @forelse ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->name }}</td>
                            <td>
                                <span class="badge badge-{{ $model->typeBadgeClass }}">{{ $model->typeText }}</span>
                            </td>
                            <td class="secondary">{{ $model->createdByText }}</td>
                            <td class="secondary">{{ $model->createdDate }}</td>
                            <td class="secondary">{{ $model->updatedDate }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('role.edit', ['role' => $model->id]) }}" title="{{ __('Edit') }}" class="btn btn-primary btn-sm fa fa-pencil"></a>
                                <a href="{{ route('role.destroy', ['role' => $model->id]) }}" title="{{ __('Delete') }}" class="btn btn-danger btn-sm fa fa-trash" @click="confirmDelete($event)"></a>
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