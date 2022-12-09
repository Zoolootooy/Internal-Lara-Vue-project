@extends('layouts.frontend')

@section('title', $page->link_name)

@section('content')
    <home-page
        :sliders="{{ json_encode($slides, JSON_UNESCAPED_UNICODE) }}"
        :benefits="{{ json_encode($benefits, JSON_UNESCAPED_UNICODE) }}"
        :articles="{{ json_encode($articles, JSON_UNESCAPED_UNICODE) }}"
        :gallery="{{ json_encode($images, JSON_UNESCAPED_UNICODE) }}"
        :faqs="{{ json_encode($faqs, JSON_UNESCAPED_UNICODE) }}"
        current-article-route="{{route('home.articles')}}"
    >
    </home-page>
@endsection
