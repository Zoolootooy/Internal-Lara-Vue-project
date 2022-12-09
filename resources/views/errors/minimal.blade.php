<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')
<body>
    <div class="account-pages my-5 pt-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="text-center mb-4">
                        <h1 class="display-2 font-weight-medium">
                            @yield('code')
                        </h1>
                        <h4 class="text-uppercase">
                            @yield('message')
                        </h4>
                        <div class="mt-5 text-center">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ url('/') }}">{{ __('Go to Main Page') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-xl-5">
                    <div>
                        <img src="/images/picture/error-img.png" alt="" class="img-fluid" />
                    </div>
                </div>
            </div>
            @include('partials.links')
        </div>
    </div>
    @include('partials.script')
</body>
</html>