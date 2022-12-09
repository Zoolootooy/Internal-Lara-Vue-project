@php $models = $quotes @endphp
@if (count($models) > 0)
    <section class="section" id="quotes">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <div class="small-title">{{ __('Features') }}</div>
                        <h4>{{ __('Key Features of the Product') }}</h4>
                    </div>
                </div>
            </div>
            @foreach ($models as $model)
                @php $even = $loop->index % 2 == 0 @endphp
                <div class="row align-items-center pt-5">
                    @if (!empty($model->image) && $even)
                        <div class="col-md-6 col-sm-8">
                            <div>
                                <img src="{{ $model->getFileUrl('image') }}" alt="{{ $model->name }}" class="img-fluid mx-auto d-block" />
                            </div>
                        </div>
                    @endif
                    <div class="@if (!empty($model->image)) col-md-5 @else col-md-12 @endif @if ($even) ml-auto @endif">
                        <div class="mt-4 @if (!empty($model->image) && $even) mt-md-auto @else mr-md-0 @endif ">
                            <div class="d-flex align-items-center mb-2">
                                <div class="features-number font-weight-semibold display-4 mr-3">{{ sprintf('%02d', $loop->iteration) }}</div>
                                <h4 class="mb-0">{{ $model->name }}</h4>
                            </div>
                            <p class="text-muted">{!! $model->description !!}</p>
                        </div>
                    </div>
                    @if (!empty($model->image) && !$even)
                        <div class="col-md-6 col-sm-8 ml-md-auto">
                            <div>
                                <img src="{{ $model->getFileUrl('image') }}" alt="{{ $model->name }}" class="img-fluid mx-auto d-block" />
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </section>
@endif