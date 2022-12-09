@if ($model->$field)
    @php ($title = $model::$title)
    @php ($class = $class ?? 'avatar-sm')
    <a href="{{ $model->getFileUrl($field) }}" target="_blank">
        <img class="img-thumbnail img-cover {{ $class }} rounded-circle" src="{{ $model->getThumbnailUrl($field) }}" alt="{{ $model->$title }}" />
    </a>
@endif