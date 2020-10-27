@extends('admin.main')
@section('content')

@include('admin.templates.page_header',['pageIndex' => true])

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title',['title' => 'Danh Sách'])
            <div class="x_content">
                @include('admin.pages.category_product.list',['items' => $items])
            </div>
        </div>
    </div>
</div>

@endsection