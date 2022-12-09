<nav class="navbar navbar-expand-lg navigation fixed-top sticky">
    <div class="container">
        <a class="navbar-logo" href="{{ url('/') }}">
            <img src="/images/logo.png" alt="" height="37" class="logo logo-dark" />
            <img src="/images/logo.png" alt="" height="37" class="logo logo-light" />
        </a>
        <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
            <i class="fa fa-fw fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="topnav-menu-content">
            <ul class="navbar-nav ml-auto" id="topnav-menu" >
                @foreach($menuItems as $item)
                    @php ($itemClass = $item->itemClass)
                    @if ($item->itemVisible)
                        <li class="nav-item {{ $itemClass }}">
                            <a href="{{ $item->itemUrl }}" class="nav-link {{ $itemClass }}-toggle @if (Str::after($item->itemUrl, '/') == 'logout') logout-link @endif" data-toggle="{{ $itemClass }}">
                                {{ $item->link_name }}
                            </a>
                            @if (count($item->children))
                                <div class="dropdown-menu dropdown-menu-right">
                                    @foreach($item->children as $child)
                                        @if ($child->itemVisible)
                                            <a class="dropdown-item" href="{{ $child->itemUrl }}">{{ $child->link_name }}</a>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</nav>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
