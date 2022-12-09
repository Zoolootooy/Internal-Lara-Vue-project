@extends('layouts.frontend')

@section('title', $page->link_name)

@section('content')
    <section class="section">
        <div class="container">
            @if (!empty($page->link_name))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mb-5">
                            <h2 class="small-title">{{ $page->link_name }}</h2>
                        </div>
                    </div>
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if (!empty($page->content))
                <div class="row card">
                    <div class="col-lg-12 card-body">
                        {!! $page->content !!}
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
