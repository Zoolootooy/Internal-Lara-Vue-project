@extends('layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($model, ['route' => 'faqCategory.store']) !!}
                        @include('admin.faqCategory.partials.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
