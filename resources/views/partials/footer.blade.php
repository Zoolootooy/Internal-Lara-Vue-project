<footer class="landing-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="mb-4 mb-lg-0">
                    <h5 class="mb-3 footer-list-title">{{ __('Information') }}</h5>
                    <ul class="list-unstyled footer-list-menu">
                        @foreach($menuItems as $item)
                            @if ($item->itemVisible && empty($item->page))
                                <li>
                                    <a href="{{ $item->itemUrl }}">{{ $item->link_name }}</a>
                                </li>
                            @endif
                            @if (count($item->children))
                                @foreach($item->children as $child)
                                    @if ($child->itemVisible && empty($child->page))
                                        <li>
                                            <a href="{{ $child->itemUrl }}">{{ $child->link_name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="mb-4 mb-lg-0">
                    <h5 class="mb-3 footer-list-title">{{ __('User') }}</h5>
                    <ul class="list-unstyled footer-list-menu">
                        @foreach($menuItems as $item)
                            @if ($item->itemVisible && !empty($item->page))
                                <li>
                                    <a href="{{ $item->itemUrl }}" @if (Str::after($item->itemUrl, '/') == 'logout') class="logout-link" @endif>{{ $item->link_name }}</a>
                                </li>
                            @endif
                            @if (count($item->children))
                                @foreach($item->children as $child)
                                    @if ($child->itemVisible && !empty($child->page) && !$loop->first)
                                        <li>
                                            <a href="{{ $child->itemUrl }}" @if (Str::after($item->itemUrl, '/') == 'logout') class="logout-link" @endif>{{ $child->link_name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            @if (count($posts) > 0)
                <div class="col-lg-3 col-sm-6">
                    <div class="mb-4 mb-lg-0">
                        <h5 class="mb-3 footer-list-title">{{ __('Latest Posts') }}</h5>
                        <div class="blog-post">
                            @foreach ($posts as $post)
                                <a href="{{ route('blog.show', ['model' => $post]) }}" class="post">
                                    <h5 class="post-title">{{ $post->link_name }}</h5>
                                    <p class="mb-0"><i class="far fa-calendar-alt mr-1"></i> {{ $post->createdDate }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <hr class="footer-border my-5">
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-4">
                    <img src="images/logo.png" alt="" height="30" />
                </div>
                <p class="mb-2">
                    <a href="{{ url('/') }}" class="text-muted">
                        {{ now()->year }} © Solid CMS
                    </a>
                </p>
                <p>
                    <a href="https://solid-sl.com/" target="_blank" class="text-muted">
                        {{ __('Created by') }} Solid Solutions
                    </a>
                </p>
            </div>
        </div>
    </div>
</footer>