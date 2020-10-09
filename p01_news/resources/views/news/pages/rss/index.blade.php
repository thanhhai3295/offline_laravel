@extends('news.main',['title' => 'Tin Tức Tổng Hợp'])
@section('content')
<div class="section-category">
    @include('news.block.breadcrumb',['item' => ['name' => 'Tin Tức']])
    <div class="content_container container_category">
        <div class="featured_title">
            <div class="container">
                <div class="row">
                    <!-- Main Content -->
                    <div class="col-lg-8">
                        @include('news.pages.rss.child-index.category_grid',['item' => $itemsNews])
                    </div>
                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <div class="sidebar">
                        @include('news.pages.rss.child-index.gold',['item' => $itemsGold])
                        @include('news.pages.rss.child-index.coin',['item' => $itemsCoin])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection