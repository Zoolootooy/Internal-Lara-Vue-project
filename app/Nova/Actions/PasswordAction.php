<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Password;
use App\Http\Requests\PasswordRequest as FormRequest;
use App\Traits\RuleTrait;

class PasswordAction extends Action
{
    use InteractsWithQueue, Queueable, RuleTrait;

    /**
     * @var string
     */
    public static $request = FormRequest::class;

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return __('Change Password');
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            try {
                $model->update([
                    'password' => $fields->new_password,
                ]);
            } catch (Exception $e) {
                return Action::danger(__('Data saving error.'));
            }
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Password::make(__('Password'), 'new_password')
                ->rules($this->fieldRules('new_password'))
                ->required(),

            Password::make(__('Confirm Password'), 'confirm_password')
                ->rules($this->fieldRules('confirm_password'))
                ->required(),
        ];
    }
}
