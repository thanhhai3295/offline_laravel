<div class="profile clearfix">
    <div class="profile_pic">
        <img src="{{ asset('assmin/img/img.jpg') }}" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Welcome,</span>
        <h2>Hai Dep Trai</h2>
    </div>
</div>
<!-- /menu profile quick info -->
<br/>
<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
            <li><a href="{{ route('user') }}"><i class="fa fa-user"></i> User</a></li>
            <li><a href="{{ route('category') }}"><i class="fa fa fa-building-o"></i> Category</a></li>
            <li><a href="{{ route('article') }}"><i class="fa fa-newspaper-o"></i> Article</a></li>
            <li><a href="{{ route('slider') }}"><i class="fa fa-sliders"></i> Silders</a></li>
            <li><a href="{{ route('menu') }}"><i class="fa fa-bars"></i> Menu</a></li>
            <li><a href="{{ route('rss') }}"><i class="fa fa-rss"></i> Rss</a></li>
            <li><a href="{{ route('contact') }}"><i class="fa fa-phone"></i> Contact</a></li>
            <li><a href="{{ route('setting') }}"><i class="fa fa-cog"></i> Setting</a></li>
            <li><a href="{{ route('nestedset') }}"><i class="fa fa-sliders"></i> NestedSet</a></li>
            <li><a href="{{ route('categoryproduct') }}"><i class="fa fa-cogs"></i> Cat-Product</a></li>
            <li>
                <a href="#">
                    <i class="fa fa-product-hunt"></i> Product Manager<span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu" style="display: none;">
                    <li><a href="{{ route('product') }}"><i class="fa fa-credit-card"></i> Product</a></li>
                    <li><a href="{{ route('attribute') }}"><i class="fa fa-sitemap"></i> Attribute</a></li>
                    <li><a href="{{ route('groupattr') }}"><i class="fa fa-object-group"></i> Group Attr</a></li>
                </ul>
            </li>
            <li><a href="{{ route('province') }}"><i class="fa fa-truck"></i> Province</a></li>
            <li><a href="{{ route('coupon') }}"><i class="fa fa-percent"></i> Coupon</a></li>
        </ul>
    </div>
</div>
