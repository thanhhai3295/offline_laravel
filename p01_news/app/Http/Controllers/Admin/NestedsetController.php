<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NestedsetModel as MainModel;
use Illuminate\Http\Request;
use Config;
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
      if($request->id) {
        $node = $this->model->find($request->id);
        $node->delete();
      }
      $node = $this->model->create([
        'name'   => $request->name,
        'status' => 'active'
        ]); 
      if($request->parent && $request->parent != 'default') {
        $parent = $this->model->find($request->parent);
        //$parent->appendNode($node);
        $node->appendToNode($parent)->save();
      }
      return redirect()->route($this->controllerName)->with('success','Add Success!');
    }
    public function form(Request $request) {
      $item = null;
      if(!empty($request->id)) {
        $params['id'] = $request->id;
        $item = $this->model->getItem($params,['task' => 'get-item']);
      }
      $arrParent = $this->model->defaultOrder()->get()->toTree()->toArray();
      return view($this->pathViewController.'form',[
        'item' => $item,
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
    public function status(Request $request){
      $params['id'] = $request->id;
      $params['status'] = $request->status;
      $this->model->saveItems($params,['task' => 'change-status']);
      $tmplStatus = Config::get('zvn.template.status');
      $currentStatus = ($params['status'] == 'active') ? 'inactive' : 'active';
      $data['name'] = $tmplStatus[$currentStatus]['name'];
      $data['status'] = $currentStatus;
      $data['class'] = $tmplStatus[$currentStatus]['class'];
      $data['success'] = true;
      echo \json_encode($data);
    }
    public function delete(Request $request) {
      $node = $this->model->find($request->id);
      $node->delete();
      return redirect()->route($this->controllerName)->with('success','Delete Success!');
    }
}