<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', config('app.name', 'Solid CMS'))</title>
    <link rel="shortcut icon" href="{{ URL::asset('images/favicon.ico')}}" />

    @yield('css')
{{--    <link href="{{ URL::asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />--}}
    <link href="{{ URL::asset('css/app-rtl.min.css')}}" id="app-rtl" rel="stylesheet" type="text/css" @if ($theme != 'rtl') disabled @endif />
    <link href="{{ URL::asset('css/app-dark.min.css')}}" id="app-dark" rel="stylesheet" type="text/css" @if ($theme != 'dark') disabled @endif />
    <link href="{{ URL::asset('css/app.min.css')}}" id="app-light" rel="stylesheet" type="text/css" @if ($theme != 'light') disabled @endif />
</head>
