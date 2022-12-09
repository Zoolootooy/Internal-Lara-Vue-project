<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')
<link href="{{ URL::asset('css/frontend.min.css')}}"  rel="stylesheet" type="text/css" />

<body data-spy="scroll" data-target="#topnav-menu" data-offset="60">
<div id="app">
    <navbar></navbar>
    @yield('content')
    <my-footer></my-footer>
</div>
@include('partials.delete')
@include('partials.script')
</body>
</html>
