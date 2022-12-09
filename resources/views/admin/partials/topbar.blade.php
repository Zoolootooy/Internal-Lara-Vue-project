<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!--a href="index" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="/images/logo.png" alt="" height="22" />
                    </span>
                    <span class="logo-lg">
                        <img src="/images/logo-dark.png" alt="" height="17" />
                    </span>
                </a>
                <a href="index" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="/images/logo.png" alt="" height="22" />
                    </span>
                    <span class="logo-lg">
                        <img src="/images/logo-light.png" alt="" height="19" />
                    </span>
                </a-->
                <a href="{{ url('admin') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="/images/logo.png" alt="" height="32" />
                    </span>
                    <span class="logo-lg">
                        <img src="/images/logo.png" alt="" height="40" />
                        Solid CMS
                    </span>
                </a>
                <a href="{{ url('admin') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="/images/logo.png" alt="" height="32" />
                    </span>
                    <span class="logo-lg">
                        <img src="/images/logo.png" alt="" height="40" />
                        Solid CMS
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <div class="app-search d-none d-lg-block">
                <search></search>
            </div>

            <div class="dropdown dropdown-mega d-none d-lg-block ml-2">
                <button type="button" class="btn header-item waves-effect" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                    Bookmarks
                    <i class="mdi mdi-chevron-down"></i>
                </button>
                <div class="dropdown-menu dropdown-megamenu">
                    <h3>{{ __('Modules') }}</h3>
                    <ul class="row megamenu-list">
                       @foreach ($unitList as $model)
                           @php
                                $route = $model->slug . '.index';
                                $route = Route::has($route) ? $route : 'admin';
                           @endphp
                           <li class="col-md-3">
                               <a href="{{ route($route) }}">{{ $model->name }}</a>
                           </li>
                       @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ml-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-search-dropdown">
                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="{{ __('Search') }}..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!--div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="" src="{{ asset('/images/flags/' . (session('locale') !== null ? session('locale') : request()->getLocale()) .  '.jpg') }}" alt="Header Language" height="16" />
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('locale', 'spa') }}" class="dropdown-item notify-item">
                        <img src="/images/flags/spa.jpg" alt="user-image" class="mr-1" height="12" />
                        <span class="align-middle">{{ __('Spanish') }}</span>
                    </a>
                    <a href="{{ route('locale', 'de') }}" class="dropdown-item notify-item">
                        <img src="/images/flags/de.jpg" alt="user-image" class="mr-1" height="12" />
                        <span class="align-middle">{{ __('German') }}</span>
                    </a>
                    <a href="{{ route('locale', 'it') }}" class="dropdown-item notify-item">
                        <img src="/images/flags/it.jpg" alt="user-image" class="mr-1" height="12" />
                        <span class="align-middle">{{ __('Italian') }}</span>
                    </a>
                    <a href="{{ route('locale', 'ru') }}" class="dropdown-item notify-item">
                        <img src="/images/flags/ru.jpg" alt="user-image" class="mr-1" height="12" />
                        <span class="align-middle">{{ __('Russian') }}</span>
                    </a>
                </div>
            </div-->

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    @if (!empty($newMailNumber))
                        <span class="badge badge-danger badge-pill">{{ $newMailNumber }}</span>
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0">{{ __('Email list') }}</h6>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('mail.index') }}" class="small">{{ __('View All') }}</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        @foreach ($mails as $model)
                            <a href="{{ route('mail.edit', $model->id) }}" class="text-reset notification-item">
                                <div class="media">
                                    <div class="avatar-xs mr-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-14">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-0 mb-1">
                                            {{ $model->subject }}
                                            @if (!$model->opened)
                                                &nbsp;<span class="badge badge-success">{{ __('New') }}</span>
                                            @endif
                                        </h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">{{ Str::limit(strip_tags($model->body)) }}</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> {{ $model->diffForHumans }}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="p-2 border-top">
                        <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="{{ route('mail.index') }}">
                            <i class="mdi mdi-arrow-right-circle mr-1"></i> {{ __('View More') }}...
                        </a>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="fas fa-cog"></i>
                </button>
            </div>

            <div class="dropdown d-none d-lg-inline-block ml-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="fas fa-expand"></i>
                </button>
            </div>

            @auth
                @php ($user = Auth::user())
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="{{ !empty($user->avatar) ? $user->getThumbnailUrl('avatar') : '/images/empty-avatar.png' }}" alt="{{ $user->username }}" />
                        <span class="d-none d-xl-inline-block ml-1">{{ $user->username }}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('user.edit', $user->id) }}"><i class="fas fa-user align-middle mr-1"></i> {{ __('Edit Profile') }}</a>
                        <a class="dropdown-item" href="{{ route('user.password', $user->id) }}"><i class="fas fa-key align-middle mr-1"></i> {{ __('Change Password') }}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger logout-link" href="#"><i class="fas fa-power-off align-middle mr-1 text-danger"></i> {{ __('Logout') }} </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</header>
