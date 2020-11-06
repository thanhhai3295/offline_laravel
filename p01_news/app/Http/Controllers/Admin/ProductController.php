<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\ProductModel as MainModel;
use App\Models\GroupattrModel;
use App\Models\AttributeModel;
use DB;
use Config;
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
        if(isset($params['attr'])) {
          $tmp = [];
          for ($i = 0; $i < count($params['attr']); $i++) {
            $tmp[$i]['name'] = $params['attr']['name'][$i];
            $tmp[$i]['value']  = explode(',',$params['attr']['value'][$i]);
          }
          unset($params['attr']);
          $params['attribute'] = json_encode($tmp);
        }
        if(isset($params['thumb']) && isset($params['alt'])) {
          $tmp = [];
          for ($i = 0; $i < count($params['thumb']); $i++) {
            $tmp[$i]['name'] = $params['thumb'][$i];
            $tmp[$i]['alt']  = $params['alt'][$i];
          }
          unset($params['alt']);
          $params['thumb'] = json_encode($tmp);
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
      }
      
      $arrParent = CategoryproductModel::defaultOrder()->get()->toTree()->toArray();
      $groupattrModel = new GroupattrModel();
      $itemsGroupAttribute = $groupattrModel->listItems(null,['task' => 'news-list-items-in-selectbox']);
      return view($this->pathViewController.'form',[
        'item' => $item,
        'arrParent' => $arrParent,
        'itemsGroupAttribute' => $itemsGroupAttribute
      ]);
    }
    public function upload(Request $request) {
      $thumbObj = $request->file('file');
      $thumbName = Str::random(10).'.'.$thumbObj->clientExtension();
      $thumbObj->storeAs($this->controllerName,$thumbName,'zvn_store_images');
      return response()->json([
        'name' => $thumbName,
        'url'  => asset("assmin/img/$this->controllerName/$thumbName"),
        ]);
    } 
    public function price(Request $request) {
      $params['id'] = $request->id;
      $params['price'] = $request->price;
      $this->model->saveItems($params,['task' => 'change-price']);
      echo true;
    }
    public function attribute(Request $request) {
      return view($this->pathViewController.'attribute',[]);
    }
    public function groupAttribute(Request $request) {
      return view($this->pathViewController.'group-attribute',[]);
    }
    public function addFormAttr(){
      $id = request()->id;
      $result = DB::table('attr')->where('attr_group_id','LIKE',"%$id%")->pluck('name');
      $xhtml = '';
      if($result) {
        foreach ($result as $key => $value) {
          $xhtml .= '<div class="form-group">
                      <div class="row">
                        <div class="col-md-3">
                          <input class="form-control" type="text" name="attr[name][]" value="'.$value.'" readonly>
                        </div>
                        <div class="col-md-9">
                          <input class="form-control tags" type="text" name="attr[value][]">
                        </div>
                      </div>
                    </div>';
        }
      }
      echo $xhtml;
    }
}