<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\ArticleModel;
class RssController extends Controller
{
    private $controllerName     = 'rss';
    private $pathViewController = 'news.pages.rss.';
    private $params             = [];
    public function __construct()
    {
      view()->share('controllerName',$this->controllerName);
    }
    public function index(Request $request)
    { 
      return view($this->pathViewController.'index',[
        'params' => $this->params,
        'items' => 'items',
      ]);
    }
    
}