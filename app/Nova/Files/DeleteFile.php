<?php
namespace App\Nova\Files;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteFile
{
    /**
     * Delete the field's underlying file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string|null  $disk
     * @param  string|null  $path
     * @return array
     */
    public function __invoke(Request $request, $model, $disk, $path)
    {
        if (!$path || count($request->allFiles()) > 0) {
            return;
        }

        Storage::deleteDirectory($model->getDirectoryPath());

        return [
            'image' => null,
        ];
    }
}