<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\CategoryproductModel as NestedsetModel;
class ProductController extends Controller
{
    private $controllerName     = 'product';
    private $pathViewController = 'news.pages.product.';
    private $params             = [];
    public function __construct()
    {
      view()->share('controllerName',$this->controllerName);
    }
    public function index(Request $request)
    { 
      $params['id'] = $request->id;
      $params['category_id'] = $request->category_id;
      $productModel = new ProductModel();
      $itemsProduct = $productModel->getItem($params,['task' => 'news-get-items']);
      $arrBreadcrumb = NestedsetModel::defaultOrder()->ancestorsOf($params['category_id'])->toArray();
      $arrBreadcrumb[] = NestedsetModel::find($params['category_id'])->toArray();
      $itemsProduct['breadcrumb'] = $arrBreadcrumb;
      $itemsProduct['breadcrumb'][] = ['name' => $itemsProduct['name']];
      
      return view($this->pathViewController.'index',[
        'itemsProduct' => $itemsProduct
      ]);
    }
    
}