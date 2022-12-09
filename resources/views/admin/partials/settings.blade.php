<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title px-3 py-4">
            <a href="javascript:void(0);" class="right-bar-toggle float-right">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
            <h5 class="m-0">{{ __('Settings') }}</h5>
        </div>
        <hr class="mt-0" />
        <h6 class="text-center">{{ __('Choose Layouts') }}</h6>
        <div class="p-4">
            <div class="mb-2">
                <img src="/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="" />
            </div>
            <div class="custom-control custom-switch mb-3">
                <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked />
                <label class="custom-control-label" for="light-mode-switch">{{ __('Light Mode') }}</label>
            </div>
            <div class="mb-2">
                <img src="/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="" />
            </div>
            <div class="custom-control custom-switch mb-3">
                <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsStyle="/css/bootstrap-dark.min.css" data-appStyle="/assets/css/app-dark.min.css" />
                <label class="custom-control-label" for="dark-mode-switch">{{ __('Dark Mode') }}</label>
            </div>
            <div class="mb-2">
                <img src="/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="" />
            </div>
            <div class="custom-control custom-switch mb-5">
                <input type="checkbox" class="custom-control-input theme-choice" id="rtl-mode-switch" data-appStyle="/css/app-rtl.min.css" />
                <label class="custom-control-label" for="rtl-mode-switch">{{ __('RTL Mode') }}</label>
            </div>
        </div>
    </div>
</div>