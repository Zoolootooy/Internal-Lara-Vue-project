@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6 mt-2">
                    <h3 class="card-title">{{ __('All Settings') }}</h3>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('setting.create') }}" class="btn btn-success btn-rounded">
                        <i class="mdi mdi-plus"></i>
                        {{ __('Add Setting') }}
                    </a>
                </div>
            </div>
            @include('admin.setting.partials.filters')
            <div class="table-wrapper">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Key') }}</th>
                        <th>{{ __('Value') }}</th>
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('Value Type') }}</th>
                        <th class="secondary">{{ __('Created By') }}</th>
                        <th class="secondary">{{ __('Created At') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    @forelse ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->title }}</td>
                            <td>{{ $model->key }}</td>
                            <td>{{ $model->value }}</td>
                            <td>
                                <span class="badge badge-{{ $model->typeBadgeClass }}">{{ $model->typeText }}</span>
                            </td>
                            <td>
                                <span class="badge badge-{{ $model->valueTypeBadgeClass }}">{{ $model->valueTypeText }}</span>
                            </td>
                            <td class="secondary">{{ $model->createdByText }}</td>
                            <td class="secondary">{{ $model->createdDate }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('setting.edit', ['setting' => $model->id]) }}" title="{{ __('Edit') }}" class="btn btn-primary btn-sm fa fa-pencil"></a>
                                @if ($model->type != $model::TYPE_SYSTEM)
                                    <a href="{{ route('setting.destroy', ['setting' => $model->id]) }}" title="{{ __('Delete') }}" class="btn btn-danger btn-sm fa fa-trash" @click="confirmDelete($event)"></a>
                                @endif
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
