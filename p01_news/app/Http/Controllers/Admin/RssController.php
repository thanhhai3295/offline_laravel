<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RssModel as MainModel;
use Illuminate\Http\Request;
use App\Http\Requests\RssRequest as MainRequest;
class RssController extends AdminController
{
    public function __construct()
    { 
      $this->pathViewController = 'admin.pages.rss.';
      $this->controllerName     = 'rss';
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
    public function ordering(Request $request) {
      $params['id'] = $request->id;
      $params['ordering'] = $request->ordering;
      $this->model->saveItems($params,['task' => 'change-ordering']);
      echo true;
    }
    public function source(Request $request){
      $params['id'] = $request->id;
      $params['source'] = $request->source;
      $this->model->saveItems($params,['task' => 'change-source']);
      echo true;
    }
}