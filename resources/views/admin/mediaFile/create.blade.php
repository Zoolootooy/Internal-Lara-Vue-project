@extends('layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($model, ['route' => 'mediaFile.store', 'files' => true]) !!}
                        @include('admin.mediaFile.partials.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
