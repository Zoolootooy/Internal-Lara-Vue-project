@extends('layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($model, ['route' => ['role.update', $model->id]]) !!}
                        @method('PUT')
                        @include('admin.role.partials.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        @include('admin.partials.statistics')

    </div>
@endsection
