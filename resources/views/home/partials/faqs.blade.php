@php $models = $faqs @endphp
@if (count($models) > 0)
    <section class="section" id="faqs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <div class="small-title">{{ __('FAQs') }}</div>
                        <h4>{{ __('Frequently Asked Questions') }}</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="vertical-nav">
                        <div class="row">
                            @if (count($models) > 0)
                                <div class="col-lg-2 col-sm-4">
                                    <div class="nav flex-column nav-pills" role="tablist">
                                        @foreach ($models as $model)
                                            <a class="nav-link @if ($loop->first) active @endif" id="category-{{ $model->id }}-tab" data-toggle="pill" href="#category-{{ $model->id }}" role="tab">
                                                <i class="far fa-question-circle nav-icon d-block mb-2"></i>
                                                <p class="font-weight-bold mb-0">{{ $model->name }}</p>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div class="@if (count($models) > 0) col-lg-10 col-sm-8 @endif">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            @foreach ($models as $model)
                                                <div class="tab-pane fade show @if ($loop->first) active @endif" id="category-{{ $model->id }}" role="tabpanel">
                                                    <h4 class="card-title mb-4">{{ $model->name }}</h4>
                                                    <div>
                                                        <div id="gen-ques-accordion" class="accordion custom-accordion">
                                                            @forelse ($model->items as $item)
                                                                <div class="@if (!$loop->last) mb-3 @endif">
                                                                    <a href="#general-collapse{{ $item->id }}" class="accordion-list @if (!$loop->first) collapsed @endif" data-toggle="collapse" aria-expanded="@if ($loop->first) true @endif" aria-controls="general-collapse{{ $item->id }}">
                                                                        <div>{{ $item->name }}</div>
                                                                        <i class="mdi mdi-minus accor-plus-icon"></i>
                                                                    </a>
                                                                    <div id="general-collapse{{ $item->id }}" class="collapse @if ($loop->first) show @endif" data-parent="#gen-ques-accordion">
                                                                        <div class="card-body">
                                                                            <p class="mb-0">{!! TextHelper::formattedWithSettings($item->description) !!}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @empty
                                                                <p>{{ __('No FAQ questions in the selected category.') }}</p>
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif