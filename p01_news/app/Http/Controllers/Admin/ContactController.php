<?php

namespace App\Http\Controllers\Admin;

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
    
}