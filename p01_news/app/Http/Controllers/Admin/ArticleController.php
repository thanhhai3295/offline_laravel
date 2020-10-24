<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleModel as MainModel;
use App\Models\NestedsetModel;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest as MainRequest;
class ArticleController extends AdminController
{
    public function __construct()
    { 
      $this->pathViewController = 'admin.pages.article.';
      $this->controllerName     = 'article';
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
    public function form(Request $request)
    { 
      $item = null;
      if(!empty($request->id)) {
        $params['id'] = $request->id;
        $item = $this->model->getItem($params,['task' => 'get-item']);
      }
      
      $arrParent = NestedsetModel::defaultOrder()->get()->toTree()->toArray();
      return view($this->pathViewController.'form',[
        'item' => $item,
        'arrParent' => $arrParent
      ]);
    }

}