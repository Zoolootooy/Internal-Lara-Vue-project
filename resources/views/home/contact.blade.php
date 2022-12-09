@extends('layouts.frontend')

@section('title', $page->link_name)

@section('content')
    <feedback-page feedback-route="{{route('send')}}"></feedback-page>
@endsection
