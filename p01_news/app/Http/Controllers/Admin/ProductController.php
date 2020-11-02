<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\ProductModel as MainModel;
use App\Models\CategoryproductModel;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest as MainRequest;
class ProductController extends AdminController
{
    public function __construct()
    { 
      $this->pathViewController = 'admin.pages.product.';
      $this->controllerName     = 'product';
      parent::__construct();
      $this->model = new MainModel();
    }
    public function save(MainRequest $request) {
      if($request->method() == 'POST') {
        $params = $request->all();
        echo '<pre>';
        print_r($params);
        echo '</pre>';die();
        $task = 'add-item';
        $notify = 'Add Item Success!';
        if($params['id'] != NULL) {
          $task = 'edit-item';
          $notify = 'Edit Item Success!';
        }
        $this->model->saveItems($params,['task' => $task]);
        return redirect()->route($this->controllerName)->with('success',$notify);
      }
    }
    public function form(Request $request)
    { 
      $item = null;
      if(!empty($request->id)) {
        $params['id'] = $request->id;
        $item = $this->model->getItem($params,['task' => 'get-item']);
      }
      
      $arrParent = CategoryproductModel::defaultOrder()->get()->toTree()->toArray();
      return view($this->pathViewController.'form',[
        'item' => $item,
        'arrParent' => $arrParent
      ]);
    }
    public function upload(Request $request) {
      $thumbObj = $request->file('file');
      $thumbName = Str::random(10).'.'.$thumbObj->clientExtension();
      $thumbObj->storeAs($this->controllerName,$thumbName,'zvn_store_images');
      return response()->json(['name' => $thumbName]);
    } 
    public function attribute(Request $request) {
      return view($this->pathViewController.'attribute',[]);
    }
    public function groupAttribute(Request $request) {
      return view($this->pathViewController.'group-attribute',[]);
    }
}