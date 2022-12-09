@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6 mt-2">
                    <h3 class="card-title">{{ __('All Translations') }}</h3>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('translation.create') }}" class="btn btn-success btn-rounded">
                        <i class="mdi mdi-plus"></i>
                        {{ __('Add Translation') }}
                    </a>
                    <a href="{{ route('translation.export') }}" class="btn btn-warning btn-rounded">
                        {{ __('Export Translation') }}&nbsp;
                        <i class="fas fa-file-export"></i>
                    </a>
                </div>
            </div>
            @include('admin.translation.partials.filters')
            <div class="table-wrapper">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Group') }}</th>
                        <th>{{ __('Key') }}</th>
                        @foreach($languages as $language)
                            <th>{{ ucfirst($language) }} {{ __('Translation') }}</th>
                        @endforeach
                        <th>{{ __('Published') }}</th>
                        <th class="secondary">{{ __('Created At') }}</th>
                        <th class="secondary">{{ __('Updated At') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    @forelse ($models as $model)
                        <tr>
                            <td>{{ $loop->iteration + $startNumber }}</td>
                            <td>{{ $model->group }}</td>
                            <td>{!! $model->key !!}</td>
                            @foreach($languages as $language)
                                <td>
                                    @if (optional($model->$language)->value)
                                        {!! $model->$language->value !!}
                                    @else
                                        <span class="badge badge-secondary">{{ __('Not Set') }}</span>
                                    @endif
                                </td>
                            @endforeach
                            <td>
                                <span class="badge badge-{{ $model->publishedBadgeClass }}">{{ $model->publishedText }}</span>
                            </td>
                            <td class="secondary">{{ $model->groupedCreated }}</td>
                            <td class="secondary">{{ $model->groupedUpdated }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('translation.edit', ['translation' => $model->groupedId]) }}" title="{{ __('Edit') }}" class="btn btn-primary btn-sm fa fa-pencil"></a>
                                <a href="{{ route('translation.destroy', ['translation' => $model->groupedId]) }}" title="{{ __('Delete') }}" class="btn btn-danger btn-sm fa fa-trash" @click="confirmDelete($event)"></a>
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
