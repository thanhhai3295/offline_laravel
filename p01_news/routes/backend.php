<?php 
  $prefixAdmin = Config::get('zvn.url.prefix_admin');

  Route::group(['prefix' => $prefixAdmin,'middleware' => ['permission.admin']], function () {
    // --------------- DASHBOARD ---------------
    $prefix = 'dashboard';
    $controllerName = 'dashboard';
    Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
      $controller = 'App\Http\Controllers\admin\\'.ucfirst($controllerName).'Controller@';
      Route::get('/',$controller.'index')->name($prefix);
    });
    // --------------- SLIDER ---------------
    $prefix = 'slider';
    $controllerName = 'slider';
    Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
      $controller = 'App\Http\Controllers\admin\\'.ucfirst($controllerName).'Controller@';
      Route::get('/',$controller.'index')->name($prefix);
      Route::get('form/{id?}',$controller.'form')->where('id','[0-9]+')->name($controllerName.'/form');
      Route::post('save',$controller.'save')->name($controllerName.'/save');
      Route::get('delete/{id}',$controller.'delete')->where('id','[0-9]+')->name($controllerName.'/delete');
      Route::get('change-status-{status}/{id}',$controller.'status')->where('id','[0-9]+')->name($controllerName.'/status');
    });
    // --------------- Menu ---------------
    $prefix = 'menu';
    $controllerName = 'menu';
    Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
      $controller = 'App\Http\Controllers\admin\\'.ucfirst($controllerName).'Controller@';
      Route::get('/',$controller.'index')->name($prefix);
      Route::get('form/{id?}',$controller.'form')->where('id','[0-9]+')->name($controllerName.'/form');
      Route::post('save',$controller.'save')->name($controllerName.'/save');
      Route::get('delete/{id}',$controller.'delete')->where('id','[0-9]+')->name($controllerName.'/delete');
      Route::get('change-status-{status}/{id}',$controller.'status')->where('id','[0-9]+')->name($controllerName.'/status');
      Route::get('change-type-{menu_type}/{id}',$controller.'type')->where('id','[0-9]+')->name($controllerName.'/menu_type');
      Route::get('change-ordering-{ordering}/{id}',$controller.'ordering')->where('id','[0-9]+')->name($controllerName.'/ordering');
    });
    // --------------- CATEGORY ---------------
    $prefix = 'category';
    $controllerName = 'category';
    Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
      $controller = 'App\Http\Controllers\admin\\'.ucfirst($controllerName).'Controller@';
      Route::get('/',$controller.'index')->name($prefix);
      Route::get('form/{id?}',$controller.'form')->where('id','[0-9]+')->name($controllerName.'/form');
      Route::post('save',$controller.'save')->name($controllerName.'/save');
      Route::get('delete/{id}',$controller.'delete')->where('id','[0-9]+')->name($controllerName.'/delete');
      Route::get('change-status-{status}/{id}',$controller.'status')->where('id','[0-9]+')->name($controllerName.'/status');
      Route::get('change-is-home-{isHome}/{id}',$controller.'isHome')->where('id','[0-9]+')->name($controllerName.'/isHome');
      Route::get('change-display-{display}/{id}',$controller.'display')->where('id','[0-9]+')->name($controllerName.'/display');
    });
    // --------------- ARTICLE ---------------
    $prefix = 'article';
    $controllerName = 'article';
    Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
      $controller = 'App\Http\Controllers\admin\\'.ucfirst($controllerName).'Controller@';
      Route::get('/',$controller.'index')->name($prefix);
      Route::get('form/{id?}',$controller.'form')->where('id','[0-9]+')->name($controllerName.'/form');
      Route::post('save',$controller.'save')->name($controllerName.'/save');
      Route::get('delete/{id}',$controller.'delete')->where('id','[0-9]+')->name($controllerName.'/delete');
      Route::get('change-status-{status}/{id}',$controller.'status')->where('id','[0-9]+')->name($controllerName.'/status');
      Route::get('change-type-{type}/{id}',$controller.'type')->where('id','[0-9]+')->name($controllerName.'/type');
    });
    // --------------- USER ---------------
    $prefix = 'user';
    $controllerName = 'user';
    Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
      $controller = 'App\Http\Controllers\admin\\'.ucfirst($controllerName).'Controller@';
      Route::get('/',$controller.'index')->name($prefix);
      Route::get('form/{id?}',$controller.'form')->where('id','[0-9]+')->name($controllerName.'/form');
      Route::post('save',$controller.'save')->name($controllerName.'/save');
      Route::get('delete/{id}',$controller.'delete')->where('id','[0-9]+')->name($controllerName.'/delete');
      Route::get('change-status-{status}/{id}',$controller.'status')->where('id','[0-9]+')->name($controllerName.'/status');
      Route::get('change-level-{level}/{id}',$controller.'level')->where('id','[0-9]+')->name($controllerName.'/level');
      Route::post('change-level',$controller.'level')->where('id','[0-9]+')->name($controllerName.'/change-level');
      Route::post('change-password',$controller.'change_password')->name($controllerName.'/change-password');
    });
    // --------------- RSS ---------------
    $prefix = 'rss';
    $controllerName = 'rss';
    Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
      $controller = 'App\Http\Controllers\admin\\'.ucfirst($controllerName).'Controller@';
      Route::get('/',$controller.'index')->name($prefix);
      Route::get('form/{id?}',$controller.'form')->where('id','[0-9]+')->name($controllerName.'/form');
      Route::post('save',$controller.'save')->name($controllerName.'/save');
      Route::get('delete/{id}',$controller.'delete')->where('id','[0-9]+')->name($controllerName.'/delete');
      Route::get('change-status-{status}/{id}',$controller.'status')->where('id','[0-9]+')->name($controllerName.'/status');
      Route::get('change-source-{source}/{id}',$controller.'source')->where('id','[0-9]+')->name($controllerName.'/source');
      Route::get('change-ordering-{ordering}/{id}',$controller.'ordering')->where('id','[0-9]+')->name($controllerName.'/ordering');
    });
    // --------------- CONTACT ---------------
    $prefix = 'contact';
    $controllerName = 'contact';
    Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
      $controller = 'App\Http\Controllers\admin\\'.ucfirst($controllerName).'Controller@';
      Route::get('/',$controller.'index')->name($prefix);
      Route::get('form/{id?}',$controller.'form')->where('id','[0-9]+')->name($controllerName.'/form');
      Route::post('save',$controller.'save')->name($controllerName.'/save');
      Route::get('delete/{id}',$controller.'delete')->where('id','[0-9]+')->name($controllerName.'/delete');
      Route::get('change-status-{status}/{id}',$controller.'contact')->where('id','[0-9]+')->name($controllerName.'/status');
    });
    // --------------- SETTING ---------------
    $prefix = 'setting';
    $controllerName = 'setting';
    Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
      $controller = 'App\Http\Controllers\admin\\'.ucfirst($controllerName).'Controller@';
      Route::get('/',$controller.'form')->name($prefix);
      Route::post('save',$controller.'save')->name($controllerName.'/save');
    });
    // --------------- NESTED SET ---------------
    $prefix = 'nestedset';
    $controllerName = 'nestedset';
    Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
      $controller = 'App\Http\Controllers\admin\\'.ucfirst($controllerName).'Controller@';
      Route::get('/',$controller.'index')->name($prefix);
      Route::get('form/{id?}',$controller.'form')->where('id','[0-9]+')->name($controllerName.'/form');
      Route::post('save',$controller.'save')->name($controllerName.'/save');
      Route::get('delete/{id}',$controller.'delete')->where('id','[0-9]+')->name($controllerName.'/delete');
      Route::get('change-node-{node}/{id}',$controller.'node')->where('id','[0-9]+')->name($controllerName.'/node');
      Route::get('change-status-{status}/{id}',$controller.'status')->where('id','[0-9]+')->name($controllerName.'/status');
    });

    // --------------- CATEGORY PRODUCT ---------------
    $prefix = 'categoryproduct';
    $controllerName = 'categoryproduct';
    Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
      $controller = 'App\Http\Controllers\admin\\'.ucfirst($controllerName).'Controller@';
      Route::get('/',$controller.'index')->name($prefix);
      Route::get('form/{id?}',$controller.'form')->where('id','[0-9]+')->name($controllerName.'/form');
      Route::post('save',$controller.'save')->name($controllerName.'/save');
      Route::get('delete/{id}',$controller.'delete')->where('id','[0-9]+')->name($controllerName.'/delete');
      Route::get('change-node-{node}/{id}',$controller.'node')->where('id','[0-9]+')->name($controllerName.'/node');
      Route::get('change-status-{status}/{id}',$controller.'status')->where('id','[0-9]+')->name($controllerName.'/status');
    });
    // --------------- PRODUCT ---------------
    $prefix = 'product';
    $controllerName = 'product';
    Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
      $controller = 'App\Http\Controllers\admin\\'.ucfirst($controllerName).'Controller@';
      Route::get('/',$controller.'index')->name($prefix);
      Route::get('form/{id?}',$controller.'form')->where('id','[0-9]+')->name($controllerName.'/form');
      Route::post('save',$controller.'save')->name($controllerName.'/save');
      Route::get('delete/{id}',$controller.'delete')->where('id','[0-9]+')->name($controllerName.'/delete');
      Route::get('change-status-{status}/{id}',$controller.'status')->where('id','[0-9]+')->name($controllerName.'/status');
      Route::get('change-price-{price}/{id}',$controller.'price')->where('id','[0-9]+')->name($controllerName.'/price');
      Route::get('change-type-{type}/{id}',$controller.'type')->where('id','[0-9]+')->name($controllerName.'/type');
      Route::post('upload',$controller.'upload')->name($controllerName.'/upload');
      Route::post('attribute',$controller.'attribute')->name($controllerName.'/attribute');
      Route::post('group-attribute',$controller.'groupAttribute')->name($controllerName.'/groupAttribute');
      Route::post('addFormAttr',$controller.'addFormAttr')->name($controllerName.'/addFormAttr');
    });

    // --------------- Attribute ---------------
    $prefix = 'attribute';
    $controllerName = 'attribute';
    Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
      $controller = 'App\Http\Controllers\admin\\'.ucfirst($controllerName).'Controller@';
      Route::get('/',$controller.'index')->name($prefix);
      Route::get('form/{id?}',$controller.'form')->where('id','[0-9]+')->name($controllerName.'/form');
      Route::post('save',$controller.'save')->name($controllerName.'/save');
      Route::get('delete/{id}',$controller.'delete')->where('id','[0-9]+')->name($controllerName.'/delete');
      Route::get('change-status-{status}/{id}',$controller.'status')->where('id','[0-9]+')->name($controllerName.'/status');
    });

    // --------------- Group Attribute ---------------
    $prefix = 'groupattr';
    $controllerName = 'groupattr';
    Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
      $controller = 'App\Http\Controllers\admin\\'.ucfirst($controllerName).'Controller@';
      Route::get('/',$controller.'index')->name($prefix);
      Route::get('form/{id?}',$controller.'form')->where('id','[0-9]+')->name($controllerName.'/form');
      Route::post('save',$controller.'save')->name($controllerName.'/save');
      Route::get('delete/{id}',$controller.'delete')->where('id','[0-9]+')->name($controllerName.'/delete');
      Route::get('change-status-{status}/{id}',$controller.'status')->where('id','[0-9]+')->name($controllerName.'/status');
    });

  });
  
?>