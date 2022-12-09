<div class="col-md-4">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title pb-3">{{ __('Statistics') }}</h4>

            <p class="form-group">
                {{ __('Registered At') }}:
                <span class="text-muted">
                    @if ($model->created_at)
                        {{ $model->createdDate }} {{ $model->createdTime }}
                    @else
                        -
                    @endif
                </span>
            </p>

            <div class="form-group">
                {{ __('Updated At') }}:
                <span class="text-muted">
                    @if ($model->updated_at)
                        {{ $model->updatedDate }} {{ $model->updatedTime }}
                    @else
                        -
                    @endif
                </span>
            </div>

            <div class="form-group">
                {{ __('Email Verified At') }}:
                <span class="text-muted">
                    @if ($model->email_verified_at)
                        {{ $model->emailVerifiedDate }} {{ $model->emailVerifiedDate }}
                    @else
                        -
                    @endif
                </span>
            </div>

            <div class="form-group">
                {{ __('Last Login At') }}:
                <span class="text-muted">
                    @if ($model->last_login_at)
                        {{ $model->lastLoginDate }} {{ $model->lastLoginTime }}
                    @else
                        -
                    @endif
                </span>
            </div>
        </div>
    </div>
</div>