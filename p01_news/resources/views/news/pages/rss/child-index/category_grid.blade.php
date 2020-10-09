<div class="world">
    <div class="section_title_container d-flex flex-row align-items-start justify-content-start">
        <div>
            <div class="section_title">Tin Tức</div>
        </div>
        <div class="section_bar"></div>
    </div>
    <div class="row world_row">
        <div class="col-lg-11">
            <div class="row" id="news_rss">
                @foreach ($item as $item)
                    <div class="col-lg-6">
                        <div class="post_item post_v_small d-flex flex-column align-items-start justify-content-start">
                            @include('news.pages.rss.child-index.image',['item' => $item])
                            @include('news.pages.rss.child-index.content',['item' => $item,'lengthContent' => 300])
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center col-md-12" id="load_more">
                <img src="{{asset('blog/images/circle.gif')}}" alt="">
            </div>
            {{-- <div class="row">
                <div class="home_button mx-auto text-center"><a href="the-loai/giao-duc-2.html">Xem
                    thêm</a></div>
            </div> --}}
        </div>
    </div>
</div>