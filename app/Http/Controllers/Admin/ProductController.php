<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductRequest as Request;
use App\Models\Product as Model;

class ProductController extends AdminController
{
    /**
     * @var string
     */
    public $controllerName = 'product';

    public function index()
    {
        $product = Model::where('type', '0')
            ->get();

        $tag = Model::where('type', '1')->get();

        return $this->view('index', ['product' => $product, 'tags' => $tag]);
    }

    public function edit(Model $product)
    {
        if($product->type === '0')
            $product->type = 0;
        else
            $product->type = 1;

        return $this->view('edit', [
            'model' => $product,
        ]);
    }

    public function update(Model $product,Request $request)
    {
        $product->fill($request->all());

        $product->save();

        return $this->redirect('index');
    }

    public function store(ProductRequest $request)
    {
        (new Model)->fill($request->all())->save();

        return $this->redirect('index');
    }

    public function create()
    {
        return $this->view('create', [
            'model' => new Model(),
        ]);
    }

    public function destroy($id)
    {
        $status = Model::find($id)->delete();

        return $this->redirect('index')
            ->with($status ? 'status' : null, __('The record is deleted.'));
    }

    public function getTags(){
        return Model::where('type', '1')->get();
    }
}
