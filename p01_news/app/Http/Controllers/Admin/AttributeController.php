<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttributeModel as MainModel;
use App\Models\GroupattrModel as GroupAttrModel;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest as MainRequest;
use Illuminate\Support\MessageBag;
class AttributeController extends AdminController
{
    public function __construct()
    {
      $this->pathViewController = 'admin.pages.attribute.';
      $this->controllerName     = 'attribute';
      parent::__construct();
      $this->model = new MainModel();
    }
    public function save(MainRequest $request,MessageBag $messageBag) {
      if($request->method() == 'POST') {
        $params = $request->all();
        if(!isset($params['groupAttr'])) {
          $messageBag->add('groupAttr','Please Select Group Attribute');
          return redirect()->back()->withErrors($messageBag);
        }
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
        $item['attr_group_id'] = json_decode($item['attr_group_id']);
      }
      $groupAttrModel = new GroupAttrModel();
      $itemGroupAttr = $groupAttrModel->listItems(null,['task' => 'news-list-items-in-selectbox']);

      return view($this->pathViewController.'form',[
        'item' => $item,
        'itemGroupAttr' => $itemGroupAttr
      ]);
    }
}