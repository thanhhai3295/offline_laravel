<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProvinceModel as MainModel;
use Illuminate\Http\Request;
use App\Http\Requests\ProvinceRequest as MainRequest;
class ProvinceController extends AdminController
{
    public function __construct()
    {
      $this->pathViewController = 'admin.pages.province.';
      $this->controllerName     = 'province';
      parent::__construct();
      $this->model = new MainModel();
    }
    public function save(MainRequest $request) {
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
    public function fee(Request $request) {
      $params['id'] = $request->id;
      $params['fee'] = $request->fee;
      $this->model->saveItems($params,['task' => 'change-fee']);
      echo true;
    }
}