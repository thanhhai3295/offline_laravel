<?php

namespace App\Http\Controllers\News;
use App\Http\Controllers\Controller;
use App\Models\ContactModel as MainModel;
use App\Models\SettingModel;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest as MainRequest;
use App\Helpers\Mailer;
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
      $SettingModel = new SettingModel();
      $itemsInfo = $SettingModel->getItem(null,['task' => 'setting-main']);
      $itemsEmail = $SettingModel->getItem(null,['task' => 'setting-email']);
      return view($this->pathViewController.'index',[
        'itemsInfo' => $itemsInfo,
        'itemsEmail'=> $itemsEmail
      ]);
    }
    public function save(MainRequest $request)
    { 
      if($request->method() == 'POST') {
        $params = $request->all();
        $this->model->saveItems($params,['task' => 'add-item']);
        if(!empty($params['email'])) {
          $SettingModel = new SettingModel();
          $mailInfo = $SettingModel->getItem(null,['task' => 'setting-email']);
          Mailer::sendMail($mailInfo,$params['email']);
        }
      return redirect()->route($this->controllerName.'/index')->with('news_success','Cảm ơn bạn đã gửi thông tin liên. Chúng tôi sẽ liên hệ bạn trong thời gian sớm nhất.');
      }
    }
    
}