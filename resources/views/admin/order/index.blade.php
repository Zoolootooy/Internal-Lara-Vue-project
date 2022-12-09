@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6 mt-2">
                    <h3 class="card-title">{{ __('All Orders') }}</h3>
                </div>
            </div>
            @include('admin.order.partials.filters')
            @if(!empty($models))
            <div class="table-wrapper">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th>{{ __('ID') }}</th>
                            <th>{{ __('Payment Type') }}</th>
                        <th>{{ __('Full Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{ __('Address') }}</th>
                        <th>{{ __('Extend Cards') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th class="secondary">{{ __('Created At') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    @forelse ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>@if(empty($model->transaction_id))
                                    {{__('Оплата наложеным платежом')}}
                                @else
                                    {{__('Оплата онлайн')}}
                                @endif</td>
                            <td>{{ $model->full_name }}</td>
                            <td>{{ $model->email }}</td>
                            <td>{{ $model->phone }}</td>
                            <td>{{ $model->address }}</td>
                            <td>@if($model->extern_cards==0){{ __('нет') }}
                                @else{{ __('Да') }}
                                @endif</td>
                            <td>
                                @switch($model->status)
                                    @case(0) {{ __('new') }} @break
                                    @case(1) {{ __('wait') }} @break
                                    @case(2) {{ __('send') }} @break
                                    @case(3) {{ __('delivered') }} @break
                                    @case(4) {{ __('canceled') }} @break
                                    @case(5) {{ __('error') }} @break
                                @endswitch</td>
                            <td class="secondary">{{ $model->created_at }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('order.edit', ['order' => $model->id]) }}" title="{{ __('Edit') }}" class="btn btn-primary btn-sm fa fa-pencil"></a>
                                <a href="{{ route('order.destroy', ['order' => $model->id]) }}" title="{{ __('Delete') }}" class="btn btn-danger btn-sm fa fa-trash" @click="confirmDelete($event)"></a>
                            </td>
                        </tr>
                    @empty
                        @include('admin.partials.noRecord')
                    @endforelse
                </table>
            </div>
        </div>
        @else
            <div>no results</div>
        @endif
    </div>
@endsection
