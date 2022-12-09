@extends('layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($model, ['route' => 'quote.store', 'files' => true]) !!}
                        @include('admin.quote.partials.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
