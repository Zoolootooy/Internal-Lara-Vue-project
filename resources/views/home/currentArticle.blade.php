@extends('layouts.frontend')


@section('content')
    <current-article-page
    :article="{{ json_encode($article, JSON_UNESCAPED_UNICODE) }}">

    </current-article-page>
@endsection
