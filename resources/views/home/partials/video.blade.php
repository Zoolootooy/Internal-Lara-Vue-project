@if (!empty($model->video_url))
    <div class="owl-video" href="{{ $model->video_url }}"></div>
    <!--iframe
            width="100%"
            height="315"
            src="{{ $model->video_url }}"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
    </iframe-->
@endif