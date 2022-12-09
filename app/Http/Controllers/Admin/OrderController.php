<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product as Tags;
use App\Models\Order as Model;
use Illuminate\Http\Request;

class OrderController extends AdminController
{
    public $controllerName = 'order';

    public function index()
    {
        $models = Model::orderBy('id', 'desc')->get();

        return $this->view('index', [
            'models' => $models,
            'filters' => new Model(),
        ]);
    }

    public function edit(Model $order){
        $tags = Tags::where('type', 'tag')->orderBy('name')->get();
        $order->extern_cards_list = str_replace("\n", ', ', $order->extern_cards_list );
        return $this->view('edit', [
            'model' => $order,
            'tags' => $tags
        ]);
    }


    public function update(Request $request, Model $order){
        $order->fill($request->all())->save();

        return $this->redirect('index');
    }

    public function destroy(Model $order){
        $status = $order->delete();

        return $this->redirect('index')
            ->with($status ? 'status' : null, __('The record is deleted.'));
    }
}
