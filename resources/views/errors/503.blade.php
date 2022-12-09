<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')
<body>
    <div class="account-pages my-5 pt-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="home-wrapper text-center mb-5">
                        <h1 class="display-4 font-weight-medium">
                            {{ __('Under Maintenance') }}
                        </h1>
                        <h5 class="text-uppercase">
                            {{ __('Please check back in sometime') }}
                        </h5>
                    </div>
                </div>
                <div class="col-md-7 col-xl-5">
                    <div>
                        <img src="/images/picture/maintenance.png" alt="" class="img-fluid mx-auto d-block" />
                    </div>
                </div>
            </div>
            @include('partials.links')
        </div>
    </div>
    @include('partials.script')
</body>
</html>