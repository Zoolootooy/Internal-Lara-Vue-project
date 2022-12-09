@extends('layouts.backend')

@section('content')
    <div class="row mb-3 mt-3">
        <div class="col-6 mt-2">
            <h3 class="card-title">{{ __('All Media Files') }}</h3>
        </div>
        <div class="col-6 text-right">
            <a href="{{ route('mediaFile.create') }}" class="btn btn-success btn-rounded">
                <i class="mdi mdi-plus"></i>
                {{ __('Add Media File') }}
            </a>
        </div>
    </div>

    @include('admin.mediaFile.partials.filters')

    @if (count($models) > 0)
        <div class="row">
            @foreach($models as $model)
                <div class="col-xl-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-body">
                            @component('components.image', [
                                'model' => $model,
                                'field' => 'file',
                                'class' => 'avatar-lg',
                            ])
                            @endcomponent
                            <div class="p-2">
                                <h5 class="font-size-14">
                                    <a href="{{ route('mediaFile.edit', ['mediaFile' => $model->id]) }}" class="@if ($model->name) text-dark @else text-muted @endif">
                                        @if ($model->name)
                                            {{ $model->name }}
                                        @else
                                            {{ __('No name') }}
                                        @endif
                                    </a>
                                </h5>
                                <p class="text-muted">
                                    @if ($model->category)
                                        <i class="far fa-folder-open mr-1"></i>
                                        {{ optional($model->category)->name }}
                                    @else
                                        &nbsp;
                                    @endif
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <span class="badge badge-{{ $model->visibleBadgeClass }}">
                                        @if ($model->visible)
                                            {{ __('Visible') }}
                                        @else
                                            {{ __('Hidden') }}
                                        @endif
                                    </span>
                                </div>
                                <div class="col-sm-4">
                                    @if (!empty($model->created_by))
                                        <i class="far fa-user-circle text-muted mr-1"></i>
                                        {{ Str::limit($model->createdByText, 6) }}
                                    @endif
                                </div>
                                <div class="col-sm-5">
                                    @if (!empty($model->created_at))
                                        <i class="fa fa-calendar-alt text-muted mr-1"></i>
                                        {{ $model->createdDate }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-top">
                            <div class="text-nowrap">
                                <a href="{{ route('mediaFile.edit', ['mediaFile' => $model->id]) }}" title="{{ __('Edit') }}" class="btn btn-primary btn-sm fa fa-pencil mr-1"></a>
                                <a href="{{ route('mediaFile.destroy', ['mediaFile' => $model->id]) }}" title="{{ __('Delete') }}" class="btn btn-danger btn-sm fa fa-trash" @click="confirmDelete($event)"></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $models->links() }}
    @else
        <div class="card">
            <div class="card-body">
                @include('admin.partials.noRecord')
            </div>
        </div>
    @endif
@endsection