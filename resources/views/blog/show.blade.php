@extends('layouts.frontend')

@section('title', $model->link_name)

@section('content')
    <div class="container">
        <div class="text-center mt-5 mb-5">
            <div class="small-title">{{ __('Blog') }}</div>
            <h4>{{ $model->link_name }}</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <article>
                    <!--p>
                        {{ __('Created By') }} {{ $model->createdByText }} on {{ $model->createdDate }}
                    </p-->
                    <p>
                        {!! $model->content !!}
                    </p>
                </article>
            </div>
        </div>
    </div>
@endsection
