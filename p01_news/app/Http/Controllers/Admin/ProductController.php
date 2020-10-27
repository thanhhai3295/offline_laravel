<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Storage;
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
    public function save(Request $request) {
      if($request->method() == 'POST') {
        $params = $request->all();
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
      $data['name'] = $_FILES['file']['name'];
      $data['file'] = $_FILES['file'];
      echo json_encode($data);
    }
}