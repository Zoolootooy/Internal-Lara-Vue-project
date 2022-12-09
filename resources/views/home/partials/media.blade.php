@php $models = $images @endphp
@if (count($models) > 0)
    <section class="section bg-white" id="media">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <div class="small-title">{{ __('Gallery') }}</div>
                        <h4>{{ __('Interface Images') }}</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($models as $model)
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            @if (!empty($model->file))
                                <div class="card-body text-center">
                                    <img src="{{ $model->getFileUrl('file') }}" alt="{{ $model->name }}" class="img-fluid" />
                                </div>
                            @endif
                            <div class="px-4 py-3 border-top">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item mr-3">
                                        <span class="badge badge-primary">{{ __('Screenshot') }}</span>
                                    </li>
                                    @if (!empty($model->name))
                                        <li class="list-inline-item mr-6">
                                            {{ $model->name }}
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
