<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SettingModel as MainModel;
use Illuminate\Http\Request;
use App\Http\Requests\SettingRequest as MainRequest;
class SettingController extends Controller
{
    private $pathViewController = 'admin.pages.setting.';
    private $controllerName = 'setting';
    public function __construct()
    { 
      view()->share('controllerName',$this->controllerName);
      $this->model = new MainModel();
    }
    public function form()
    { 
      $itemsMain = $this->model->getItem(null,['task' => 'setting-main']);
      return view($this->pathViewController.'form',[
        'itemsMain' => $itemsMain
      ]);
    }
    public function save(Request $request) {
      $params = $request->all();
      $this->model->saveItems($params,['task' => 'edit-item']);
      return redirect()->route($this->controllerName)->with('success','Save Success!');
    }
}