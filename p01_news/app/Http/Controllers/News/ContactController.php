<?php

namespace App\Http\Controllers\News;
use App\Http\Controllers\Controller;
use App\Models\ContactModel as MainModel;
use Illuminate\Http\Request;
class ContactController extends Controller
{
    private $controllerName     = 'contact';
    private $pathViewController = 'news.pages.contact.';
    private $params             = [];
    private $model;
    public function __construct()
    { 
      $this->model = new MainModel();
      view()->share('controllerName',$this->controllerName);
    }
    public function index(Request $request)
    { 
      return view($this->pathViewController.'index',[
        
      ]);
    }
    public function save(Request $request)
    { 
      $request->validate([
        'name' => 'bail|required|min:6',
        'phone' => 'bail|required|numeric',
      ]);
      if($request->method() == 'POST') {
        $params = $request->all();
        $this->model->saveItems($params,['task' => 'add-item']);
        return redirect()->route($this->controllerName.'/index')->with('news_success','Cảm ơn bạn đã gửi thông tin liên. Chúng tôi sẽ liên hệ bạn trong thời gian sớm nhất.');
      }
    }
    
}