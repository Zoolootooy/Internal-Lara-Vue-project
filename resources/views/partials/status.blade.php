@if (session('error'))
    <div class="container mt-5">
        <div class="alert alert-danger">{!! session('error') !!}</div>
    </div>
@endif
@if (session('status'))
    <div class="container mt-5">
        <div class="alert alert-success">{!! session('status') !!}</div>
    </div>
@endif

