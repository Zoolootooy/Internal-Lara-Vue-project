@extends('layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($model, ['route' => ['user.update', $model->id], 'files' => true]) !!}
                        @method('PUT')
                        @include('admin.user.partials.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        @include('admin.user.partials.statistics')

    </div>
@endsection
