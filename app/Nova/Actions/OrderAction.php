<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use App\Models\MenuItem as Model;

class OrderAction extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return __('Change Order');
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
                $model->updateOrder((int) $fields->order_type, $fields->item_id);
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
        $operationSelect = Select::make(__('Operation'), 'order_type')
            ->options(Model::orderTypes())
            ->required()->rules('required')
            ->help(__('Select order type.'));

        $itemSelect = Select::make(__('Menu Item'), 'item_id')
            ->options(array_flip(Model::listWithPadding()))
            ->required()->rules('required')

            ->help(__('Select menu item.'));

        return [
            $operationSelect,
            $itemSelect,
        ];
    }
}
