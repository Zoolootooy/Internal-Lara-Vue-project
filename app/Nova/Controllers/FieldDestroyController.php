<?php

namespace App\Nova\Controllers;

use Illuminate\Routing\Controller;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\DeleteField;
use Laravel\Nova\Nova;

class FieldDestroyController extends Controller
{
    /**
     * Delete the file at the given field.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function handle(NovaRequest $request)
    {
        $resource = $request->findResourceOrFail();

        $resource->authorizeToUpdate($request);

        $fields = isset($resource->updateFields($request)['Tabs'])
            ? $resource->updateFields($request)['Tabs']['fields'] ?? collect([])
            : $resource->updateFields($request);

        $field = $fields->findFieldByAttribute($request->field, function () {
            abort(404);
        });

        DeleteField::forRequest(
            $request, $field, $resource->resource
        )->save();

        Nova::actionEvent()->forResourceUpdate(
            $request->user(), $resource->resource
        )->save();
    }
}