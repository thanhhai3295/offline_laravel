<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NestedsetModel as MainModel;
use Illuminate\Http\Request;
class NestedsetController extends Controller
{
    private $model;
    private $controllerName     = 'nestedset';
    private $pathViewController = 'admin.pages.nestedset.';
    private $params             = [];
    public function __construct()
    {
      $this->model = new MainModel();
      view()->share('controllerName',$this->controllerName);
    }
    public function index() {
      $items = $this->model->defaultOrder()->get()->toTree();
      return view($this->pathViewController.'index',[
        'items' => $items
      ]);
    }
    public function save(Request $request) {
      $node = $this->model->create(['name' => $request->name]); 
      if($request->parent && $request->parent != 'default') {
        $parent = $this->model->find($request->parent);
        $parent->appendNode($node);
      }
      return redirect()->route($this->controllerName.'/form')->with('success','Add Success!');
    }
    public function form(Request $request) {
      $arrParent = $this->model->getItem(null,['task' => 'get-item']);
      return view($this->pathViewController.'form',[
        'arrParent' => $arrParent
      ]);
    }
    public function node(Request $request){
      $node = $this->model->find($request->id);
      if($request->node == 'up') {
        $node->up();
      } else {
        $node->down();
      }
      return redirect()->route($this->controllerName)->with('success','Change Success!');
    }
}