<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\ArticleModel;
use App\Models\NestedsetModel;
class ArticleController extends Controller
{
    private $controllerName     = 'article';
    private $pathViewController = 'news.pages.article.';
    private $params             = [];
    public function __construct()
    {
      view()->share('controllerName',$this->controllerName);
    }
    public function index(Request $request)
    { 
      $params['article_id'] = $request->article_id;
      $articleModel = new ArticleModel();
      $itemsArticle = $articleModel->getItem($params,['task' => 'news-get-items']);
      if(!($itemsArticle)) return redirect()->route('home');
      $itemsLastest = $articleModel->listItems(null,['task' => 'news-list-items-lastest']);
      $params['category_id'] = $itemsArticle['category_id'];

      $arrBreadcrumb = NestedsetModel::defaultOrder()->ancestorsOf($params['category_id'])->toArray();
      $arrBreadcrumb[] = NestedsetModel::find($params['category_id'])->toArray();
      $itemsArticle['breadcrumb'] = $arrBreadcrumb;
      
      $itemsArticle['related_articles'] = $articleModel->listItems($params,['task' => 'news-list-items-related-in-category']);
      return view($this->pathViewController.'index',[
        'params' => $this->params,
        'itemsLastest' => $itemsLastest,
        'itemsArticle' => $itemsArticle
      ]);
    }
    
}