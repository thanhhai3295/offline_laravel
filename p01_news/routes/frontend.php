<?php 
  $prefixNews  = Config::get('zvn.url.prefix_news');
  $prefixNews = null;
  Route::group(['prefix' => $prefixNews], function () {
    // --------------- DASHBOARD ---------------
    $prefix = '';
    $controllerName = 'home';
    Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
      $controller = 'App\Http\Controllers\News\\'.ucfirst($controllerName).'Controller@';
      Route::get('/',$controller.'index')->name($controllerName);
    });
  
    // --------------- CATEGORY ---------------
    $prefix = 'chuyen-muc';
    $controllerName = 'category';
    Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
      $controller = 'App\Http\Controllers\News\\'.ucfirst($controllerName).'Controller@';
      Route::get('/{category_name}-{category_id}.html',$controller.'index')->where('category_id','[0-9]+')->where('category_name','[0-9A-Za-z_-]+')->name($controllerName.'/index');
    });
    // --------------- CONTACT ---------------
    $prefix = 'lien-he';
    $controllerName = 'contact';
    Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
      $controller = 'App\Http\Controllers\News\\'.ucfirst($controllerName).'Controller@';
      Route::get('/',$controller.'index')->name($controllerName.'/index');
      Route::post('/save',$controller.'save')->name($controllerName.'/save');
    });
  
    // --------------- ARTICLE ---------------
    $prefix = '';
    $controllerName = 'Rss';
    Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
      $controller = 'App\Http\Controllers\News\\'.ucfirst($controllerName).'Controller@';
      Route::get('tin-tuc-tong-hop.html',$controller.'index')->name($controllerName.'/index');
      Route::get('get-gold',$controller.'getGold')->name($controllerName.'/getGold');
      Route::get('get-coin',$controller.'getCoin')->name($controllerName.'/getCoin');
      Route::post('get-news',$controller.'getNews')->name($controllerName.'/getNews');
    });
    // --------------- Tin Tuc Tong Hop ---------------
    $prefix = 'bai-viet';
    $controllerName = 'article';
    Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
      $controller = 'App\Http\Controllers\News\\'.ucfirst($controllerName).'Controller@';
      Route::get('/{article_name}-{article_id}.html',$controller.'index')->where('article_id','[0-9]+')->where('article_name','[0-9A-Za-z_-]+')->name($controllerName.'/index');
    });
  
    // ====================== LOGIN ========================
      // news69/login
      $prefix         = '';
      $controllerName = 'auth';
      
      Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
          $controller = 'App\Http\Controllers\News\\'.ucfirst($controllerName).'Controller@';
          Route::get('/login',$controller.'login')->name($controllerName.'/login')->middleware('check.login');
  
          Route::post('/postLogin',$controller.'postLogin')->name($controllerName.'/postLogin');
  
          // ====================== LOGOUT ========================
          Route::get('/logout',$controller.'logout')->name($controllerName.'/logout');
      });
  
      $prefix         = '';
      $controllerName = 'notify';
      Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
          $controller = 'App\Http\Controllers\News\\'.ucfirst($controllerName).'Controller@';
          Route::get('/no-permission',$controller.'noPermission')->name($controllerName.'/noPermission');
      });
  
  });
?>