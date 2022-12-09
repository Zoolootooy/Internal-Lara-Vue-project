<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var int
     */
    public $itemsPerPage = 20;

    /**
     * @var null
     */
    public $controllerName = null;

    /**
     * @var null
     */
    public $areaName = null;

    /**
     * @return string
     */
    public function getViewPath()
    {
        return $this->areaName . $this->controllerName . '.';
    }

    /**
     * @param null $view
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($view = null, $data = [])
    {
        $data['header'] = $this->getHeaderName();
        $data['title'] = $this->getTitleName();
        $data['caption'] = !empty($data['model']) ? $data['model']->caption : null;

        return view($this->getViewPath() . $view, $data);
    }

    /**
     * @param $route
     * @param array $parameters
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect($route, $parameters = [])
    {
        return redirect()->route($this->controllerName . '.' . $route, $parameters);
    }

    /**
     * @return string
     */
    public function getTitleName()
    {
        $action = request()->route()->getActionMethod();

        switch($action) {
            case 'create':
                $title = __('Add');
                break;
            case 'edit':
                $title = __('Edit');
                break;
            case 'password':
                return __('Change Password');
            case 'export':
                return __('Export');
            default:
                return $this->getHeaderName();
        }

        return $title . ' ' . $this->getControllerCaption();
    }

    /**
     * @return string
     */
    public function getHeaderName()
    {
        return __(Str::ucfirst($this->getControllerCaption()));
    }

    /**
     * @return mixed|void
     */
    public function getControllerCaption()
    {
        $controller = $this->controllerName != 'site'
            ? Str::plural(Str::ucfirst(Str::kebab($this->controllerName)))
            : 'Dashboard';

        return __(str_replace('-', ' ', $controller));
    }
}

