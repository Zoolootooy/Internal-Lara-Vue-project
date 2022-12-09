<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')
@section('body')
@show
<body data-sidebar="dark" @if (!empty(Cookie::get('sidebarStatus'))) class="vertical-collpsed" @endif>
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
    <div id="app">
        <div id="layout-wrapper">
            @include('admin.partials.topbar')
            @include('admin.partials.sidebar')
            <div class="main-content">
                <div class="page-content">
                    @include('admin.partials.status')
                    <div class="container-fluid">
                        @component('components.breadcrumb', [
                            'header' => $header,
                            'title' => $title,
                            'caption' => $caption,
                        ])
                        @endcomponent
                        @yield('content')
                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="{{ url('admin') }}" class="text-muted">
                                   {{ now()->year }} © Solid CMS
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-right d-none d-sm-block">
                                    <a href="https://solid-sl.com/" target="_blank" class="text-muted">
                                        {{ __('Created by') }} Solid Solutions
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        @include('admin.partials.settings')
        <div class="rightbar-overlay"></div>
    </div>
    @include('partials.delete')
    @include('admin.partials.script')
</body>
</html>
