@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6 mt-2">
                    <h3 class="card-title">{{ __('All Mails') }}</h3>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('mail.create') }}" class="btn btn-success btn-rounded">
                        <i class="mdi mdi-plus"></i>
                        {{ __('Add Mail') }}
                    </a>
                </div>
            </div>
            @include('admin.mail.partials.filters')
            <div class="table-wrapper">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Sender Email') }}</th>
                        <th>{{ __('Sender Name') }}</th>
                        <th>{{ __('Subject') }}</th>
                        <th>{{ __('Message') }}</th>
                        <th>{{ __('Opened') }}</th>
                        <th class="secondary">{{ __('Created At') }}</th>
                        <th class="secondary">{{ __('Updated At') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    @forelse ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->sender_email }}</td>
                            <td>{{ $model->sender_name }}</td>
                            <td>{{ $model->subject }}</td>
                            <td>{{ $model->body }}</td>
                            <td>
                                <span class="badge badge-{{ $model->openedBadgeClass }}">{{ $model->openedText }}</span>
                            </td>
                            <td class="secondary">{{ $model->createdDate }}</td>
                            <td class="secondary">{{ $model->updatedDate }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('mail.edit', ['mail' => $model->id]) }}" title="{{ __('Edit') }}" class="btn btn-primary btn-sm fa fa-pencil"></a>
                                <a href="{{ route('mail.destroy', ['mail' => $model->id]) }}" title="{{ __('Delete') }}" class="btn btn-danger btn-sm fa fa-trash" @click="confirmDelete($event)"></a>
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
