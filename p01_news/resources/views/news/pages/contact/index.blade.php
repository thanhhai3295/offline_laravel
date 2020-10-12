@extends('news.main',['title' => 'Liên Hệ'])
@section('content')
<div class="section-category">
    @include('news.block.breadcrumb',['item' => ['name' => 'Liên Hệ']])
    <div class="content_container container_category">
        <div class="featured_title">
            <div class="container">
                @include('news.templates.success')
                @include('news.pages.contact.child-index.info')
                @include('news.pages.contact.child-index.content')
            </div>
        </div>
    </div>
</div>
@endsection