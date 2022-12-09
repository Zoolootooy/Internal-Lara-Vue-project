<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

class CategoryAction extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * @var array
     */
    public $selectOptions;

    /**
     * @var bool
     */
    public $isRequired = false;

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return __('Change Category');
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
                    'parent_id' => $fields->parent_id,
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
        $select = Select::make(__('Category'), 'parent_id')
            ->options($this->selectOptions)
            ->help(__('Select category.'));

        if ($this->isRequired) {
            $select->required()->rules('required');
        }

        return [
            $select,
        ];
    }

    /**
     * @return $this
     */
    public function makeRequired()
    {
        $this->isRequired = true;

        return $this;
    }
}
