<!-- https://www.flaticon.com/packs/essential-collection/7 -->
<!-- https://www.flaticon.com/packs/marketing-and-seo-6 -->
@if(auth()->user()->roles[0]->name === "Admin")
    <div class="col-xl-3 col-md-6">
        <div class="card overflow-hidden">
            <a href="{{ route($item['module'] . '.index') }}">
                <div class="bg-soft-primary">
                    <div class="row">
                        <div class="col-8">
                            <div class="text-primary p-3">
                                @php $caption = $title ?? $item['caption'] @endphp
                                <h5 class="text-primary">{{ $caption }}</h5>
                                <span>{{ __('See All') . ' ' . $caption }}</span>
                            </div>
                        </div>
                        <div class="col-4">
                            @php $image = $image ?? $item['module'] @endphp
                            <img src="/images/icons/{{ $image }}.png" alt="{{ $item['caption'] }}" height="80"
                                 class="img-dashboard img-fluid mt-2 mb-2" style="height: 60px"/>
                        </div>
                    </div>
                </div>
            </a>
            <div class="card-body pt-0">
                <div class="pt-4">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="font-size-15">{{ $item['number'] }}</h5>
                            <p class="text-muted mb-0">{{ $item['caption'] }}</p>
                            <a href="{{ route($item['module'] . '.index') }}" class="btn btn-primary btn-sm mt-2">
                                {{ __('All items') }}
                                <i class="mdi mdi-arrow-right ml-1"></i>
                            </a>
                        </div>
                        @isset ($secondItem)
                            <div class="col-6">
                                <h5 class="font-size-15">{{ $secondItem['number'] }}</h5>
                                <p class="text-muted mb-0">{{ $secondItem['caption'] }}</p>
                                <a href="{{ route($secondItem['module'] . '.index') }}"
                                   class="btn btn-primary btn-sm mt-2">
                                    {{ __('All items') }}
                                    <i class="mdi mdi-arrow-right ml-1"></i>
                                </a>
                            </div>
                        @else
                            <div class="col-4">
                                <a href="{{ route($item['module'] . '.index') }}">
                                    <div class="col-3 pt-3 mini-stats-wid pull-right">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-info align-self-center">
                                        <span class="avatar-title">
                                            <i class="fa fa-3x fa-{{ $item['icon'] }}"></i>
                                        </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if(auth()->user()->roles[0]->name === "Editor")
    @for($i = 0; $i < count($manager); $i++)
        @if($item['module'] === $manager[$i])
            <div class="col-xl-3 col-md-6">
                <div class="card overflow-hidden">
                    <a href="{{ route($item['module'] . '.index') }}">
                        <div class="bg-soft-primary">
                            <div class="row">
                                <div class="col-8">
                                    <div class="text-primary p-3">
                                        @php $caption = $title ?? $item['caption'] @endphp
                                        <h5 class="text-primary">{{ $caption }}</h5>
                                        <span>{{ __('See All') . ' ' . $caption }}</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    @php $image = $image ?? $item['module'] @endphp
                                    <img src="/images/icons/{{ $image }}.png" alt="{{ $item['caption'] }}" height="80"
                                         class="img-dashboard img-fluid mt-2 mb-2" style="height: 60px"/>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="card-body pt-0">
                        <div class="pt-4">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="font-size-15">{{ $item['number'] }}</h5>
                                    <p class="text-muted mb-0">{{ $item['caption'] }}</p>
                                    <a href="{{ route($item['module'] . '.index') }}"
                                       class="btn btn-primary btn-sm mt-2">
                                        {{ __('All items') }}
                                        <i class="mdi mdi-arrow-right ml-1"></i>
                                    </a>
                                </div>
                                @isset ($secondItem)
                                    <div class="col-6">
                                        <h5 class="font-size-15">{{ $secondItem['number'] }}</h5>
                                        <p class="text-muted mb-0">{{ $secondItem['caption'] }}</p>
                                        <a href="{{ route($secondItem['module'] . '.index') }}"
                                           class="btn btn-primary btn-sm mt-2">
                                            {{ __('All items') }}
                                            <i class="mdi mdi-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <a href="{{ route($item['module'] . '.index') }}">
                                            <div class="col-3 pt-3 mini-stats-wid pull-right">
                                                <div
                                                    class="mini-stat-icon avatar-sm rounded-circle bg-info align-self-center">
                                        <span class="avatar-title">
                                            <i class="fa fa-3x fa-{{ $item['icon'] }}"></i>
                                        </span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endfor
@endif
@if(auth()->user()->roles[0]->name === "Author")
    @for($i = 0; $i < count($author); $i++)
        @if($item['module'] === $author[$i])
            <div class="col-xl-3 col-md-6">
                <div class="card overflow-hidden">
                    <a href="{{ route($item['module'] . '.index') }}">
                        <div class="bg-soft-primary">
                            <div class="row">
                                <div class="col-8">
                                    <div class="text-primary p-3">
                                        @php $caption = $title ?? $item['caption'] @endphp
                                        <h5 class="text-primary">{{ $caption }}</h5>
                                        <span>{{ __('See All') . ' ' . $caption }}</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    @php $image = $image ?? $item['module'] @endphp
                                    <img src="/images/icons/{{ $image }}.png" alt="{{ $item['caption'] }}" height="80"
                                         class="img-dashboard img-fluid mt-2 mb-2" style="height: 60px"/>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="card-body pt-0">
                        <div class="pt-4">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="font-size-15">{{ $item['number'] }}</h5>
                                    <p class="text-muted mb-0">{{ $item['caption'] }}</p>
                                    <a href="{{ route($item['module'] . '.index') }}"
                                       class="btn btn-primary btn-sm mt-2">
                                        {{ __('All items') }}
                                        <i class="mdi mdi-arrow-right ml-1"></i>
                                    </a>
                                </div>
                                @isset ($secondItem)
                                    <div class="col-6">
                                        <h5 class="font-size-15">{{ $secondItem['number'] }}</h5>
                                        <p class="text-muted mb-0">{{ $secondItem['caption'] }}</p>
                                        <a href="{{ route($secondItem['module'] . '.index') }}"
                                           class="btn btn-primary btn-sm mt-2">
                                            {{ __('All items') }}
                                            <i class="mdi mdi-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <a href="{{ route($item['module'] . '.index') }}">
                                            <div class="col-3 pt-3 mini-stats-wid pull-right">
                                                <div
                                                    class="mini-stat-icon avatar-sm rounded-circle bg-info align-self-center">
                                        <span class="avatar-title">
                                            <i class="fa fa-3x fa-{{ $item['icon'] }}"></i>
                                        </span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endfor
@endif
