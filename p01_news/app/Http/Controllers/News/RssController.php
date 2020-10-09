<?php

namespace App\Http\Controllers\News;
use App\Helpers\Template as Template;
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
    private $model;
    public function __construct()
    {
      $this->model = new RssModel();
      view()->share('controllerName',$this->controllerName);
    }
    public function index(Request $request)
    { 
      $arrayNews = $this->model->listItems(null,['task' => 'news-list-rss']);
      $itemsNews = [];
        switch ($arrayNews[0]['source']) {
          case 'cafebiz':
            $itemsNews = RSS::readCafebiz($arrayNews[0]['link']);
            break;
          case 'vnexpress':
            $itemsNews = RSS::readVnexpress($arrayNews[0]['link']);
            break;
        }

      return view($this->pathViewController.'index',[
        'params' => $this->params,
        'itemsNews' => $itemsNews
      ]);
    }
    public function getGold(Request $request) {
      $itemsGold = RSS::readGold('http://www.sjc.com.vn/xml/tygiavang.xml');
      $xhtml  = '<div><h3>Giá Vàng</h3><table class="table"><thead>';
      $xhtml .='<tr>
                  <th scope="col">Loại Vàng</th>
                  <th scope="col">Mua</th>
                  <th scope="col">Bán</th>
                </tr></thead><tbody>';
      foreach ($itemsGold as $key => $value) {
        $xhtml .= '<tr>
                    <td>'.$value['type'].'</td>
                    <td>'.$value['buy'].'</td>
                    <td>'.$value['sell'].'</td>
                  </tr>';
      }
      $xhtml .= '</tbody></table></div><hr>';
      
      echo $xhtml;
    }

    public function getCoin(Request $request) {
      $itemsCoin = RSS::readCoin('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=100&page=1&sparkline=false');
      $xhtml  = '<div><h3>Giá Coin</h3><table class="table"><thead>';
      $xhtml .='<tr>
                  <th scope="col">Tên</th>
                  <th scope="col">Giá USD</th>
                  <th scope="col">Thay Đổi</th>
                </tr></thead><tbody>';
      foreach ($itemsCoin as $key => $value) {
        $sell = round($value['price_change']).'%';
        $xhtml .= '<tr>
                    <td>'.$value['name'].'</td>
                    <td>'.$value['current_price'].'</td>
                    <td>'.$sell.'</td>
                  </tr>';
      }
      $xhtml .= '</tbody></table></div><hr>';
      
      echo $xhtml;
    }
    public function getNews(Request $request){
      $arrayNews = $this->model->listItems(null,['task' => 'news-list-rss']);
      $totalNews = count($arrayNews);
      $page = $request->page;
      $data = [];
      if($page >= $totalNews) {
        $data['success'] = false;
      } else {
        switch ($arrayNews[$page]['source']) {
          case 'cafebiz':
            $data = RSS::readCafebiz($arrayNews[$page]['link']);
            break;
          case 'vnexpress':
            $data = RSS::readVnexpress($arrayNews[$page]['link']);
            break;
        }
        $xhtml = '';
        foreach ($data as $key => $value) {
          $content = Template::showContent($value['description'],300);

          $xhtml .= '<div class="col-lg-6"><div class="post_item post_v_small d-flex flex-column align-items-start justify-content-start">';

          $xhtml .= '<div class="post_image">
                      <a href="'.$value['link'].'">
                        <img src="'.$value['thumb'].'" alt="'.$value['name'].'" class="img-fluid w-100">
                      </a>
                    </div>';

          $xhtml .= '<div class="post_content">
                      <div class="post_title"><a href="'.$value['link'].'">'.$value['name'].'</a></div>
                        <div class="post_info d-flex flex-row align-items-center justify-content-start">
                            <div class="post_author d-flex flex-row align-items-center justify-content-start">
                                <div class="post_author_name"><a href="#">HaiDepTrai</a>
                                </div>
                            </div>
                        <div class="post_date"><a href="#">'.$value['pubDate'].'</a></div>
                      </div>
                        <div class="post_text">
                        <p>'.$content.'</p>
                        </div>  
                    </div>';

          $xhtml .= '</div></div>';
        }
        $data['html'] = $xhtml;
        $data['success'] = true;
      }
      echo json_encode($data);
    }
}