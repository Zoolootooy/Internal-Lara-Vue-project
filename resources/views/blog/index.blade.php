@extends('layouts.frontend')

@section('title', 'Blog Posts')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Blog') }}</div>
    <div class="card-body">
        @if (count($models) > 0)
            @foreach ($models as $model)
                <article>
                    <h2>
                        <a href="{{ route('blog.show', ['model' => $model]) }}">{{ $model->link_name }}</a>
                    </h2>
                    <p>
                        {{ $model->content }}
                    </p>
                </article>
            @endforeach
            {{ $models->links() }}
        @else
            {{ __('There are no blog posts yet.') }}
        @endif
    </div>
</div>
@endsection
