@php $models = $users @endphp
@if (count($models) > 0)
    <section class="section" id="users">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <div class="small-title">{{ __('Team') }}</div>
                        <h4>{{ __('Meet our Team') }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="owl-carousel owl-theme events navs-carousel" id="team-carousel">
                    @foreach ($models as $model)
                        <div class="item">
                            <div class="card text-center team-box">
                                <div class="card-body">
                                    <div>
                                        @if (!empty($model->avatar))
                                            <img src="{{ $model->getFileUrl('avatar') }}" alt="" class="rounded" />
                                        @else
                                            <i class="fa fa-5x fa-user-circle-o pt-5 mb-5"></i>
                                        @endif
                                    </div>
                                    <div class="mt-3">
                                        <h5>{{ $model->fullName }}</h5>
                                        <p class="text-muted mb-0">{{ $model->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif