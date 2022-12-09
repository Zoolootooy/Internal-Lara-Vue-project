<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')
<body>
    @include('partials.status')
    <div class="container" id="app">
        <div class="my-5 pt-sm-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        @yield('content')
                    </div>
                    @include('partials.links')
                </div>
            </div>
        </div>
    </div>
    @include('partials.script')
</body>
</html>