<?php

namespace App\Http\Controllers\Admin;
use Config;
use App\Http\Controllers\Controller;
use App\Models\ContactModel as MainModel;
use Illuminate\Http\Request;
use App\Http\Requests\RssRequest as MainRequest;
class ContactController extends AdminController
{
    public function __construct()
    { 
      $this->pathViewController = 'admin.pages.contact.';
      $this->controllerName     = 'contact';
      parent::__construct();
      $this->model = new MainModel();
    }
    public function contact(Request $request){
      $params['id'] = $request->id;
      $params['status'] = $request->status;     
      $this->model->saveItems($params,['task' => 'change-status']);
      $tmplStatus = Config::get('zvn.template.contact');
      $currentStatus = ($params['status'] == 'active') ? 'inactive' : 'active';
      $data['name'] = $tmplStatus[$currentStatus]['name'];
      $data['status'] = $currentStatus;
      $data['class'] = $tmplStatus[$currentStatus]['class'];
      $data['success'] = true;
      echo \json_encode($data);      
    }
    
}