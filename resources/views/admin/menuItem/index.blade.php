@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6 mt-2">
                    <h3 class="card-title">{{ __('All Menu Items') }}</h3>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('menuItem.create', ['menu_id' => request('menu_id')]) }}" class="btn btn-success btn-rounded">
                        <i class="mdi mdi-plus"></i>
                        {{ __('Add Item') }}
                    </a>
                </div>
            </div>
            @include('admin.menuItem.partials.filters')
            <div class="table-wrapper">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Link Name') }}</th>
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('Page') }}</th>
                        <th>{{ __('Url') }}</th>
                        <th>{{ __('Menu') }}</th>
                        <th>{{ __('Parent') }}</th>
                        <!--th>{{ __('Inherited') }}</th-->
                        <th class="secondary">{{ __('Created By') }}</th>
                        <th class="secondary">{{ __('Created At') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    @forelse ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <th>{!! $model->itemPadding!!} {{ $model->link_name}}</th>
                            <th>
                                <span class="badge badge-{{ $model->typeBadgeClass }}">{{ $model->typeText }}</span>
                            </th>
                            <td>{{ optional($model->page)->link_name }}</td>
                            <th>{{ $model->url }}</th>
                            <td>{{ optional($model->menu)->name }}</td>
                            <td>{{ optional($model->parent)->link_name }}</td>
                            <!--th>{{ $model->inheritedText }}</th-->
                            <td class="secondary">{{ $model->createdByText }}</td>
                            <td class="secondary">{{ $model->createdDate }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('menuItem.edit', ['menuItem' => $model->id]) }}" title="{{ __('Edit') }}" class="btn btn-primary btn-sm fa fa-pencil"></a>
                                <a href="{{ route('menuItem.destroy', ['menuItem' => $model->id]) }}" title="{{ __('Delete') }}" class="btn btn-danger btn-sm fa fa-trash" @click="confirmDelete($event)"></a>
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
