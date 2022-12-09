@extends('layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($model, ['route' => ['product.update', $model->id]]) !!}
                    @method('PUT')
                    @include('admin.product.partials.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        @include('admin.partials.statistics')
    </div>
@endsection
