@extends('layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($model, ['route' => ['slider.update', $model->id], 'files' => true]) !!}
                        @method('PUT')
                        @include('admin.slider.partials.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        @include('admin.partials.statistics')

    </div>
@endsection
