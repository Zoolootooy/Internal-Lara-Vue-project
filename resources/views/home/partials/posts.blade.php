@php $models = $posts @endphp
@if (count($models) > 0)
    <section class="section bg-white" id="posts">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <div class="small-title">{{ __('Blog') }}</div>
                        <h4>{{ __('Latest Posts') }}</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($models as $model)
                    <div class="col-xl-4 col-sm-6">
                        <div class="blog-box mb-4 mb-xl-0">
                            @if (!empty($model->image))
                                <div class="position-relative">
                                    <img src="{{ $model->getFileUrl('image') }}" alt="{{ $model->link_name  }}" class="rounded img-fluid mx-auto d-block" />
                                    <div class="badge badge-success blog-badge font-size-11">{{ __('Post') }}</div>
                                </div>
                            @endif
                            <div class="mt-4 text-muted">
                                <p class="mb-2"><i class="far fa-calendar-alt mr-1"></i>{{ $model->createdDate }}</p>
                                <h5 class="mb-3">{{ $model->link_name }}</h5>
                                <p>{{ Str::limit(strip_tags($model->content), 200) }}</p>
                                <div>
                                    <a href="{{ route('blog.show', ['model' => $model]) }}">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
