<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuModel as MainModel;
use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest as MainRequest;
class MenuController extends AdminController
{
    public function __construct()
    {
      $this->pathViewController = 'admin.pages.menu.';
      $this->controllerName     = 'menu';
      parent::__construct();
      $this->model = new MainModel();
    }

    public function type(Request $request){
      $params['id'] = $request->id;
      $params['type'] = $request->menu_type;
      $this->model->saveItems($params,['task' => 'change-type']);
      echo true;
      //return redirect()->route($this->controllerName)->with('success', 'Type Updated!');;
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
    public function ordering(Request $request) {
      $params['id'] = $request->id;
      $params['ordering'] = $request->ordering;
      $this->model->saveItems($params,['task' => 'change-ordering']);
      echo true;
    }
}