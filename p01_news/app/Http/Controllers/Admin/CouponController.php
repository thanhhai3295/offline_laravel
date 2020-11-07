<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CouponModel as MainModel;
use Illuminate\Http\Request;
use App\Http\Requests\CouponRequest as MainRequest;
class CouponController extends AdminController
{
    public function __construct()
    {
      $this->pathViewController = 'admin.pages.coupon.';
      $this->controllerName     = 'coupon';
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
    public function type(Request $request) {
      $params['id'] = $request->id;
      $params['type'] = $request->type_coupon;
      $this->model->saveItems($params,['task' => 'change-type']);
      echo true;
    }
    public function value(Request $request) {
      $params['id'] = $request->id;
      $params['value'] = $request->value;
      $this->model->saveItems($params,['task' => 'change-value']);
      echo true;
    }
}