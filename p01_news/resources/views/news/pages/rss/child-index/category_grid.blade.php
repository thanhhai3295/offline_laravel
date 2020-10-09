<div class="world">
    <div class="section_title_container d-flex flex-row align-items-start justify-content-start">
        <div>
            <div class="section_title">Tin Tức</div>
        </div>
        <div class="section_bar"></div>
    </div>
    <div class="row world_row">
        <div class="col-lg-11">
            <div class="row">
                @foreach ($item as $item)
                    @foreach ($item as $item02)
                        <div class="col-lg-6">
                            <div class="post_item post_v_small d-flex flex-column align-items-start justify-content-start">
                                @include('news.pages.rss.child-index.image',['item' => $item02])
                                @include('news.pages.rss.child-index.content',['item' => $item02,'lengthContent' => 300])
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
            <div class="row">
                <div class="home_button mx-auto text-center"><a href="the-loai/giao-duc-2.html">Xem
                    thêm</a></div>
            </div>
        </div>
    </div>
</div>