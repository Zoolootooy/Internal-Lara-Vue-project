<section class="section hero-section @if (empty($slides) || count($slides) == 0) hero-section-small @endif bg-ico-hero" id="slider">
    <div class="bg-overlay bg-primary"></div>
    @if (!empty($slides) && count($slides) > 0)
        <div class="container">
            <div class="owl-carousel owl-theme events navs-carousel" id="slider-carousel">
                @foreach($slides as $model)
                    <div class="item event-list">
                        <div>
                            @php $positionLeft = $model->position == \App\Models\Slider::POSITION_LEFT @endphp
                            @php $isVideo = $model->type == \App\Models\Slider::TYPE_VIDEO @endphp
                            <div class="row align-items-center mb-5">
                                @if (!empty($model->image) && !$positionLeft)
                                    <div class="col-lg-6 col-md-8 col-sm-10 mr-lg-auto">
                                        <div class="card overflow-hidden mb-0 mt-5 mr-5 mt-lg-0">
                                            <div class="card-body">
                                                <div class="text-center">
                                                    @if ($isVideo)
                                                        @include('home.partials.video')
                                                    @else
                                                        <img src="{{ $model->getFileUrl('image') }}" alt="{{ $model->name }}" class="img-fluid" />
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-lg-6">
                                    <div class="text-white-50">
                                        <h1 class="text-white font-weight-semibold mb-3 hero-title">{{ $model->name }}</h1>
                                        {!! $model->description  !!}
                                        @if (!empty($model->button_caption) && !empty($model->forward_url))
                                            <div class="button-items mt-4">
                                                <a href="{{ $model->forward_url }}" class="btn btn-success">{{ $model->button_caption }}</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @if (!empty($model->image) && $positionLeft)
                                    <div class="col-lg-6 col-md-8 col-sm-10 ml-lg-auto">
                                        <div class="card overflow-hidden mb-0 mt-5 ml-5 mt-lg-0">
                                            <div class="card-body">
                                                <div class="text-center">
                                                    @if ($isVideo)
                                                        @include('home.partials.video')
                                                    @else
                                                        <img src="{{ $model->getFileUrl('image') }}" alt="{{ $model->name }}" class="img-fluid" />
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</section>