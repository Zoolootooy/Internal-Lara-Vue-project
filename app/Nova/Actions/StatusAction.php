<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

class StatusAction extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * @var array
     */
    public $selectOptions;

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return __('Change Status');
    }

    /**
     * ChangeVisibility constructor.
     * @param $selectOptions
     */
    public function __construct($selectOptions)
    {
        $this->selectOptions = $selectOptions;
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
                    'status' => (int) $fields->status,
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
            Select::make(__('Status'), 'status')
                ->options($this->selectOptions)
                ->required()
                ->rules('required')
                ->help(__('Determined if the user(s) is new, verified, or blocked.')),
        ];
    }
}
