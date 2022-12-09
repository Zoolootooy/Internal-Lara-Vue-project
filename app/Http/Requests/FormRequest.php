<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

class FormRequest extends BaseFormRequest
{
    /**
     * @var
     */
    protected $modelName;

    /**
     * @return \Illuminate\Routing\Route|null|object|string
     */
    public function getModel()
    {
        return $this->route($this->modelName);
    }

    /**
     * @return mixed|null
     */
    protected function getModelId()
    {
        return optional($this->getModel())->id
            ?? request()->route()->parameters['resourceId']
            ?? null;
    }
}
