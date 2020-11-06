<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryproductModel as catProductModel;
use App\Models\ProductModel;
class CategoryproductController extends Controller
{
    private $controllerName     = 'categoryproduct';
    private $pathViewController = 'news.pages.category_product.';
    private $params             = [];
    public function __construct()
    {
      view()->share('controllerName',$this->controllerName);
    }
    public function index(Request $request)
    { 
      $params['id'] = $request->category_id;
      $catProductModel = new catProductModel();
      $itemsCategory = $catProductModel->getItem($params,['task' => 'get-item']);
      if(!($itemsCategory)) return redirect()->route('home');
      $productModel = new ProductModel();  
      $itemsProduct = $productModel->getItem($params,['task' => 'cat-get-items']);
      $arrBreadcrumb   = catProductModel::defaultOrder()->ancestorsOf($params['id'])->toArray();
      $arrBreadcrumb[] = catProductModel::find($params['id'])->toArray();
      $itemsCategory['breadcrumb'] = $arrBreadcrumb;
      return view($this->pathViewController.'index',[
        'params' => $this->params,
        'itemsCategory' => $itemsCategory,
        'itemsProduct' => $itemsProduct
      ]);
    }
    
}