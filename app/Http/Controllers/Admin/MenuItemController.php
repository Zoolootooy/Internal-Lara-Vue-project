<?php

namespace App\Http\Controllers\Admin;

use App\Models\MenuItem as Model;
use App\Models\Menu;
use App\Models\Page;
use App\Http\Requests\MenuItemRequest as Request;

class MenuItemController extends AdminController
{
    /**
     * @var string
     */
    public $controllerName = 'menuItem';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $models = Model::with(['menu', 'parent', 'page', 'createdBy'])
            ->filter()
            ->defaultOrder()
            ->withDepth()
            ->paginate($this->itemsPerPage)
            ->withQueryString();

        return $this->view('index', [
            'models' => $models,
            'filters' => new Model(),
            'menus' => Menu::list(),
            'pages' => Page::list(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $model = new Model();
        $model->menu_id = request('menu_id');

        return $this->view('create', [
            'model' => $model,
            'menus' => Menu::list(),
            'pages' => Page::list(),
            'items' => Model::list(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $model = new Model($request->all());

        $model->save();

        $this->updateItemOrder($model, $request);

        return $this->redirect('index', [
            'menu_id' => $model->menu_id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Model  $menuItem
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Model $menuItem)
    {
        return $this->view('edit', [
            'model' => $menuItem,
            'menus' => Menu::list(),
            'pages' => Page::list(),
            'items' => Model::list(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Model  $menuItem
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(Request $request, Model $menuItem)
    {
        if ($response = $this->updateItemOrder($menuItem, $request)) {
            return $response;
        }

        $menuItem->fill($request->all())->save();

        return $this->redirect('index', [
            'menu_id' => $menuItem->menu_id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Model  $menuItem
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Model $menuItem)
    {
        $status = $menuItem->delete();

        return $this->redirect('index')
            ->with($status ? 'status' : null, __('The record is deleted.'));
    }

    /**
     * @param Model $menuItem
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    protected function updateItemOrder(Model $menuItem, Request $request)
    {
        if ($request->has('order', 'order_item') && !empty($request->order) && !empty($request->order_item)) {
            if ($menuItem->id == $request->order_item) {
                return redirect()->route('menuItem.edit', ['menuItem' => $menuItem->id])
                    ->withInput()
                    ->withErrors(['errors' => __('Cannot order the item against itself.')]);
            }

            $menuItem->updateOrder((int) $request->order, $request->order_item);
        }
    }
}
