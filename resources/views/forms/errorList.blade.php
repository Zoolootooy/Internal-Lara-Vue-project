@if (!$errors->isEmpty())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ str_replace(' id ', ' ', $error) }}</li>
            @endforeach
        </ul>
    </div>
@endif