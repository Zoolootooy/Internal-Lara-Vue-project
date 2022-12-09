<div class="col-md-4">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title pb-3">{{ __('Statistics') }}</h4>

            @if (isset($model->created_by))
                <p class="form-group">
                    {{ __('Created By') }}:
                    <span class="text-muted">
                        @if ($model->created_by)
                            {{ $model->createdByText }},
                            &lt;{{ $model->createdBy->email }}&gt;
                        @else
                            -
                        @endif
                    </span>
                </p>
            @endif

            <p class="form-group">
                {{ __('Created At') }}:
                <span class="text-muted">
                    @if ($model->created_at)
                        {{ $model->createdDate }} {{ $model->createdTime }}
                    @else
                        -
                    @endif
                </span>
            </p>

            <p class="form-group">
                {{ __('Updated At') }}:
                <span class="text-muted">
                    @if ($model->updated_at)
                        {{ $model->updatedDate }} {{ $model->updatedTime }}
                    @else
                        -
                    @endif
                </span>
            </p>
        </div>
    </div>
</div>