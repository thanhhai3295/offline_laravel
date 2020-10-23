<?php 
  return [
    'url' => [
      'prefix_admin' => 'admin',
      'prefix_news' => 'news'
    ],
    'format' => [
      'long_time' => 'H:m:s d/m/Y',
      'short_time'=> 'd/m/Y'
    ],
    'dashboard' => [
      'user' => ['icon' => 'fa fa-user'],
      'category' => ['icon' => 'fa fa fa-building-o'],
      'article' => ['icon' => 'fa fa-newspaper-o'],
      'slider' => ['icon' => 'fa fa-sliders'],
      'menu' => ['icon' => 'fa fa-bars'],
    ],
    'template' => [
      'form_input' => ['class' => 'form-control col-md-6 col-xs-12'],
      'form_label' => ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'],
      'form_ckeditor' => ['class' => 'control-label col-md-3 col-sm-3 col-xs-12 ckeditor'],
      'status' => [
        'all'       => ['class' => 'btn-primary', 'name' =>'All'],
        'active'    => ['class' => 'btn-success', 'name' =>'Active'],
        'inactive'  => ['class' => 'btn-danger',  'name' =>'Inactive'],
        'default'   => ['class' => 'btn-info',    'name' =>'--- Choose Status ---']
      ],
      'contact' => [
        'active'    => ['class' => 'btn-danger', 'name' =>'Chưa Gọi'],
        'inactive'  => ['class' => 'btn-success',  'name' =>'Đã Gọi'],
      ],
      'is_home' => [
        '1'       => ['class' => 'btn-dark', 'name' =>'Show'],
        '0'    => ['class' => 'btn-warning', 'name' =>'Hide']
      ],
      'level' => [
        'admin'       => ['name' =>'Admin'],
        'member'    => ['name' =>'Member']
      ],
      'display' => [
        'list'    => ['name' =>'List'],
        'grid'    => ['name' =>'Grid']
      ],
      'type' => [
        'feature'    => ['name' =>'Feature'],
        'normal'    => ['name' =>'Normal']
      ],
      'menu_type' => [
        'direct' => ['name' => 'Direct'],
        'category' => ['name' => 'Category'],
      ],
      'source' => [
        'vnexpress' => ['name' => 'Vnexpress'],
        'cafebiz' => ['name' => 'Cafebiz'],
      ],
      'search' => [
        'all'         => ['name' =>'Search By All'],
        'id'          => ['name' =>'Search By ID'],
        'name'        => ['name' =>'Search By Name'],
        'description' => ['name' =>'Search By Description'],
        'username'    => ['name' =>'Search By Username'],
        'fullname'    => ['name' =>'Search By Fullname'],
        'email'       => ['name' =>'Search By Email'],
        'link'        => ['name' =>'Search By link'],
        'content'     => ['name' =>'Search By Content'],
      ],
      'button' => [
        'edit'  => [
          'class' => 'btn-success','title' => 'Edit','icon' => 'fa-pencil','route-name' => '/form'
        ],
        'delete'=> [
          'class' => 'btn-danger btn-delete','title' => 'Delete','icon' => 'fa-trash','route-name' => '/delete'
        ],
        'info'  => [
          'class' => 'btn-danger','title' => 'Delete','icon' => 'fa-trash','route-name' => '/delete'
        ]
      ]
    ],
    'config' => [
      'search' => [
        'default' => ['all','id','fullname'],
        'slider'  => ['all','id','name','description','link'],
        'category'  => ['all','id','name'],
        'article'  => ['all','name','content'],
        'user'  => ['all','username','email'],
        'menu'  => ['all','name','link'],
        'rss'  => ['all','name','link'],
        'contact'  => ['all','name','email'],
      ],
      'button' => [
        'default' => ['edit','delete'],
        'slider'  => ['edit','delete',],
        'category'  => ['edit','delete',],
        'article'  => ['edit','delete',],
        'user'  => ['edit'],
        'menu'  => ['edit','delete',],
        'rss'  => ['edit','delete',],
        'contact'  => ['delete'],
        'nestedset' => ['edit','delete']
      ]
    ]
  ];
?>