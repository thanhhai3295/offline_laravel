<?php 
  namespace App\Helpers;
  use Illuminate\Support\Str;
  class URL {
    public static function linkCategory($name,$id) {
      return route('category/index',['category_id' => $id,'category_name' => Str::slug($name)]);
    }
    public static function linkCatProduct($name,$id) {
      return route('categoryproduct/index',['category_id' => $id,'category_name' => Str::slug($name)]);
    }
    public static function linkProduct($params) {
      return route('product/index',[
        'id' => $params['product_id'],
        'product_name' => Str::slug($params['product_name']),
        'category_id' =>$params['category_id'],
        'category_name' => Str::slug($params['category_name'])
        ]);
    }
    public static function linkArticle($name,$id) {
      return route('article/index',['article_id' => $id,'article_name' => Str::slug($name)]);
    }
  }
?>