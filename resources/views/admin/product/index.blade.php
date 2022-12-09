@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6 mt-2">
                    <h3 class="card-title">{{ __('Products') }}</h3>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('product.create') }}" class="btn btn-success btn-rounded">
                        <i class="mdi mdi-plus"></i>
                        {{ __('Add Product') }}
                    </a>
                </div>
            </div>

            <div class="table-wrapper">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    @forelse ($product as $prod)
                        <tr>
                            <td>{{ $prod->id }}</td>
                            <td>{{ $prod->name }}</td>
                            <td>{{ $prod->price }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('product.edit', ['product' => $prod->id]) }}" title="{{ __('Edit') }}"
                                   class="btn btn-primary btn-sm fa fa-pencil"></a>
                                <a href="{{ route('product.destroy', ['product' => $prod->id]) }}" title="{{ __('Delete') }}"
                                   class="btn btn-danger btn-sm fa fa-trash" @click="confirmDelete($event)"></a>
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
                    <h3 class="card-title">{{ __('Tags') }}</h3>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('product.create') }}" class="btn btn-success btn-rounded">
                        <i class="mdi mdi-plus"></i>
                        {{ __('Add Tag') }}
                    </a>
                </div>
            </div>

            <div class="table-wrapper">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    @forelse ($tags as $tag)
                        <tr>
                            <td>{{ $tag->id }}</td>
                            <td>{{ $tag->name }}</td>
                            <td>{{ $tag->price }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('product.edit', ['product' => $tag->id]) }}" title="{{ __('Edit') }}"
                                   class="btn btn-primary btn-sm fa fa-pencil"></a>
                                <a href="{{ route('product.destroy', ['product' => $tag->id]) }}" title="{{ __('Delete') }}"
                                   class="btn btn-danger btn-sm fa fa-trash" @click="confirmDelete($event)"></a>
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
