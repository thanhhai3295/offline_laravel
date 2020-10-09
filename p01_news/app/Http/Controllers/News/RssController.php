<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RssModel;
use App\Helpers\RSS;
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
      $RssModel = new RssModel();
      $arrayNews = $RssModel->listItems(null,['task' => 'news-list-rss']);
      $itemsNews = [];
      foreach ($arrayNews as $key => $value) {
        switch ($value['source']) {
          case 'cafebiz':
            $itemsNews[] = RSS::readCafebiz($value['link']);
            break;
          case 'vnexpress':
            $itemsNews[] = RSS::readVnexpress($value['link']);
            break;
        }
      }
      $itemsGold = RSS::readGold('http://www.sjc.com.vn/xml/tygiavang.xml');
      $itemsCoin = RSS::readCoin('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=100&page=1&sparkline=false');

      return view($this->pathViewController.'index',[
        'params' => $this->params,
        'itemsNews' => $itemsNews,
        'itemsGold' => $itemsGold,
        'itemsCoin' => $itemsCoin
      ]);
    }
    
}