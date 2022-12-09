@extends('layouts.frontend')

@section('title', $page->link_name)

@section('content')
    <articles-page
        :articles = "{{ json_encode($articles, JSON_UNESCAPED_UNICODE) }}"
        current-article-route = "{{route('home.articles')}}"
    ></articles-page>
@endsection
