@php
    use App\Models\CategoryproductModel as Nestedset;
    use App\Models\MenuModel as MenuModel;
    use App\Helpers\URL;
    use App\Helpers\Template;
    $nestedsetModel = new Nestedset();
    $itemsNestedset = $nestedsetModel->defaultOrder()->get()->toTree()->toArray();
    $MenuModel = new MenuModel();
    $itemsMenu = $MenuModel->listItems(null,['task' => 'menu-list-items']);

    $xhtmlMenu = '';
    $xhtmlMenuMobile = '';
    if(count($itemsMenu) > 0) {
        $xhtmlMenu = '<nav class="main_nav">
                        <ul class="main_nav_list d-flex flex-row align-items-center justify-content-start">';
        //$xhtmlMenuMobile = '<nav class="menu_nav"><ul class="menu_mm">';
        foreach ($itemsMenu as $key => $value) {
            $classActive = '';
            $xhtmlMenu .= '<li '.$classActive.'><a href="'.$value['link'].'">'.$value['name'].'</a>';
            if($value['type'] == 'category') {
                $xhtmlMenu .= Template::recursiveMenu($itemsNestedset);
            }
            $xhtmlMenu .= '</li>';
        }
        $xhtmlLogin = '<li><a href="'.route('auth/login').'">Đăng Nhập</a></li>';
        $xhtmlLogout = '<li><a href="'.route('auth/logout').'">Đăng Xuất</a></li>';
        $xhtmlAuth = session('userInfo') ? $xhtmlLogout :  $xhtmlLogin;
        $xhtmlMenu .= $xhtmlAuth.'</ul></nav>';
        //$xhtmlMenuMobile .= '</ul></nav>';
    }
@endphp
<!-- Header -->
<header class="header">
<!-- Header Content -->
    <div class="header_content_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_content d-flex flex-row align-items-center justfy-content-start">
                        <div class="logo_container">
                            <a href="{{route('home')}}">
                                <div class="logo"><span>ZEND</span>VN</div>
                            </a>
                        </div>
                        <div class="header_extra ml-auto d-flex flex-row align-items-center justify-content-start">
                            <a href="#">
                                <div class="background_image"
                                    style="background-image:url({{asset('blog/images/zendvn-online.png')}});background-size: contain"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Navigation & Search -->
    <div class="header_nav_container" id="header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_nav_content d-flex flex-row align-items-center justify-content-start">
                        <!-- Logo -->
                        <div class="logo_container">
                            <a href="#">
                                <div class="logo"><span>ZEND</span>VN</div>
                            </a>
                        </div>
                        <!-- Navigation -->
                        {!! $xhtmlMenu !!}
                        <!-- Hamburger -->
                        <div class="hamburger ml-auto menu_mm">
                            <i class="fa fa-bars  trans_200 menu_mm" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
    <div class="menu_close_container">
        <div class="menu_close">
            <div></div>
            <div></div>
        </div>
    </div>
   {!! $xhtmlMenuMobile !!}
    <div class="menu_subscribe"><a href="#">Subscribe</a></div>
</div>