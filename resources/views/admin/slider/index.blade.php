@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6 mt-2">
                    <h3 class="card-title">{{ __('All Slides') }}</h3>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('slider.create') }}" class="btn btn-success btn-rounded">
                        <i class="mdi mdi-plus"></i>
                        {{ __('Add Slide') }}
                    </a>
                </div>
            </div>
            @include('admin.slider.partials.filters')
            <div class="table-wrapper">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Image') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('Visible') }}</th>
                        <th>{{ __('Position') }}</th>
                        <th class="secondary">{{ __('Created By') }}</th>
                        <th class="secondary">{{ __('Created At') }}</th>
                        <th class="secondary">{{ __('Updated At') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    @forelse ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>
                                @component('components.image', ['model' => $model, 'field' => 'image']) @endcomponent
                            </td>
                            <td>{{ $model->name }}</td>
                            <td>{{ Str::limit(strip_tags($model->description)) }}</td>
                            <td>
                                <span class="badge badge-{{ $model->typeBadgeClass }}">{{ $model->typeText }}</span>
                            </td>
                            <td>
                                <span class="badge badge-{{ $model->visibleBadgeClass }}">{{ $model->visibleText }}</span>
                            </td>
                            <td>
                                <span class="badge badge-{{ $model->positionBadgeClass }}">{{ $model->positionText }}</span>
                            </td>
                            <td class="secondary">{{ $model->createdByText }}</td>
                            <td class="secondary">{{ $model->createdDate }}</td>
                            <td class="secondary">{{ $model->updatedDate }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('slider.edit', ['slider' => $model->id]) }}" title="{{ __('Edit') }}" class="btn btn-primary btn-sm fa fa-pencil"></a>
                                <a href="{{ route('slider.destroy', ['slider' => $model->id]) }}" title="{{ __('Delete') }}" class="btn btn-danger btn-sm fa fa-trash" @click="confirmDelete($event)"></a>
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
