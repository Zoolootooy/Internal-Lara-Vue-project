<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

class VisibilityAction extends Action
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
        return __('Change Visibility');
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
                    'visible' => (int) $fields->visible,
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
            Select::make(__('Visible'), 'visible')
                ->options($this->selectOptions)
                ->required()
                ->rules('required')
                ->help(__('Records visibility and the possibility to manage the visibility for all users at once, as well as for logged in or not logged in users separately.')),
        ];
    }
}
