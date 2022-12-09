@extends('layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($model, ['route' => ['order.update', $model->id]]) !!}
                        @method('PUT')
                        @include('admin.order.partials.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        @include('admin.partials.statistics')
    </div>
@endsection

<script>
</script>
<style>

    .tag {
        margin: 5px;
        padding: 5px;
        background-color: #3FCB89;
        border-radius: 5px;
    }
</style>
