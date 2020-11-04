@extends('news.main',['title' => $itemsProduct['name']])
@section('content')
@include('news.pages.product.elements.head')
    @php
        $attr = json_decode($itemsProduct['attribute'],true);
        $thumb = json_decode($itemsProduct['thumb'],true);
        $mainThumb = $thumb[0];
    @endphp
    @include('news.pages.product.elements.breadcrumb',['item' => $itemsProduct])
    <div class="collection-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-1 col-sm-2 col-xs-12">
                    <div class="row">
                        <div class="col-12 p-0">
                            <div class="slider-right-nav slick-initialized slick-slider slick-vertical">
                                <div class="slick-list draggable" style="height: 395.298px;">
                                    <div class="slick-track" style="opacity: 1; height: 1450px; transform: translate3d(0px, -395px, 0px);">
                                        
                                        <div class="slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" style="width: 117px;">
                                            <div>
                                                <div style="width: 100%; display: inline-block;"><img src="http://127.0.0.1:8000/product/images/pro3/1.jpg" alt="" class="img-fluid blur-up lazyloaded"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="slick-slide" data-slick-index="3" aria-hidden="true" tabindex="-1" style="width: 117px;">
                                            <div>
                                                <div style="width: 100%; display: inline-block;"><img src="http://127.0.0.1:8000/product/images/pro3/27.jpg" alt="" class="img-fluid blur-up lazyloaded"></div>
                                            </div>
                                        </div>
                                        <div class="slick-slide slick-cloned" data-slick-index="4" aria-hidden="true" tabindex="-1" style="width: 117px;">
                                            <div>
                                                <div style="width: 100%; display: inline-block;"><img src="http://127.0.0.1:8000/product/images/pro3/1.jpg" alt="" class="img-fluid blur-up lazyloaded"></div>
                                            </div>
                                        </div>
                                        @foreach ($thumb as $item)
                                            <div class="slick-slide slick-cloned" data-slick-index="5" aria-hidden="true" tabindex="-1" style="width: 117px;">
                                                <div>
                                                    <div style="width: 100%; display: inline-block;"><img src="{{asset("assmin/img/$controllerName/{$item['name']}")}}" alt="{{$item['alt']}}" class="img-fluid blur-up lazyloaded thumb-product"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-sm-10 col-xs-12 order-up">
                    <div class="product-right-slick slick-initialized slick-slider">
                        <button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="">Previous</button>
                            <div class="slick-list draggable">
                                <div class="slick-track" style="opacity: 1; width: 2216px;">
                                    <div class="slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" style="width: 554px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;">
                                        <div>
                                        <div style="width: 100%; display: inline-block;"><img src="{{asset("assmin/img/$controllerName/{$mainThumb['name']}")}}" alt="{{$mainThumb['alt']}}" class="img-fluid blur-up image_zoom_cls-0 lazyloaded" id="mainThumb-product"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="slick-next slick-arrow" aria-label="Next" type="button" style="">Next</button>
                        </div>
                     
                </div>
                <div class="col-lg-6 rtl-text">
                    <div class="product-right">
                        <h2>{{$itemsProduct['name']}}</h2>
                        {{-- <h4><del>$459.00</del><span>55% off</span></h4> --}}
                        <h3>{{number_format($itemsProduct['price']).'đ'}}</h3>
                        {{-- <ul class="color-variant">
                            <li class="bg-light0"></li>
                            <li class="bg-light1"></li>
                            <li class="bg-light2"></li>
                        </ul> --}}
                        <div class="product-description border-product">
                            @foreach ($attr as $item)
                                <h6 class="product-title size-text">select {{$item['name']}} </h6>
                                <div class="size-box">
                                    <ul>
                                        @foreach ($item['value'] as $item)
                                            <li style="width:auto;border:1px solid #ff4d3c;border-radius:6px;padding:8px 12px">
                                                <a href="#">{{$item}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                            
                            <h6 class="product-title">quantity</h6>
                            <div class="qty-box">
                                <div class="input-group"><span class="input-group-prepend"><button type="button" class="btn quantity-left-minus" data-type="minus" data-field=""><i class="ti-angle-left"></i></button> </span>
                                    <input type="text" name="quantity" class="form-control input-number" value="1">
                                    <span class="input-group-prepend"><button type="button" class="btn quantity-right-plus" data-type="plus" data-field=""><i class="ti-angle-right"></i></button></span></div>
                            </div>
                        </div>
                        <div class="product-buttons"><a href="#" data-toggle="modal" data-target="#addtocart" class="btn btn-solid">add to cart</a> <a href="#" class="btn btn-solid">buy now</a>
                        </div>
                        <div class="border-product">
                            <h6 class="product-title">product description</h6>
                            <p>{!!$itemsProduct['description']!!}</p>
                        </div>
                        <div class="border-product">
                            <h6 class="product-title">share it</h6>
                            <div class="product-icon">
                                <ul class="product-social">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-rss"></i></a></li>
                                </ul>
                                <form class="d-inline-block">
                                    <button class="wishlist-btn"><i class="fa fa-heart"></i><span class="title-font">Add To WishList</span></button>
                                </form>
                            </div>
                        </div>
                        <div class="border-product">
                            <h6 class="product-title">Time Reminder</h6>
                            <div class="timer">
                                <p id="demo"><span>25 <span class="padding-l">:</span> <span class="timer-cal">Days</span> </span><span>22 <span class="padding-l">:</span> <span class="timer-cal">Hrs</span>
                                    </span><span>13 <span class="padding-l">:</span> <span class="timer-cal">Min</span> </span><span>57 <span class="timer-cal">Sec</span></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('news.pages.product.elements.script')
<script>
    $(function() {
        
        $('.thumb-product').css('cursor','pointer');
        $('.thumb-product').click(function(){
            var src = $(this).attr('src');
            $("#mainThumb-product").fadeOut(150,function() {
                $(this).attr('src',src);
            }).fadeIn(150);
            
            return false;
        });
    });
</script>
@endsection
