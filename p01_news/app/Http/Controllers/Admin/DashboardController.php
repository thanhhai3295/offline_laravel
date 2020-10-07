<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DashboardModel as MainModel;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
    private $pathViewController = 'admin.pages.dashboard.';
    private $controllerName = 'dashboard';
    public function __construct() 
    {
      view()->share('controllerName',$this->controllerName);
      $this->model = new MainModel();
    }
    public function index()
    {
      $countItems = $this->model->countItems();
      return view($this->pathViewController.'index',[
        'countItems' => $countItems
      ]);
    }
}