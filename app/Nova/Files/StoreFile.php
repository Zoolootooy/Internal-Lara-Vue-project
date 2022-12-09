<?php
namespace App\Nova\Files;

use Illuminate\Http\Request;

class StoreFile
{
    /**
     * Store the incoming file upload.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $attribute
     * @param  string  $requestAttribute
     * @param  string  $disk
     * @param  string  $storagePath
     * @return array
     */
    public function __invoke(Request $request, $model, $attribute, $requestAttribute, $disk, $storagePath)
    {
        $model->deleteFile($attribute);
        $fileName = $model->saveFile($request->file($attribute), $attribute, 'image');

        return [
            $attribute => $fileName,
        ];
    }
}