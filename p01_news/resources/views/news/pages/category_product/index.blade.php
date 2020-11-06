@extends('news.main',['title' => $itemsCategory['name']])
@section('content')
@include('news.multicart-theme.head')
    
    @include('news.multicart-theme.breadcrumb',['item' => $itemsCategory])
    {{-- PRODUCT --}}
    <div class="container">
        <div class="collection-product-wrapper">
            @include('news.multicart-theme.product-top-filter')
            <div class="product-wrapper-grid">
                <div class="row margin-res">
                    @include('news.pages.category_product.list',['item' => $itemsProduct])
                </div>
            </div>
            @include('news.multicart-theme.product-pagination')
        </div>
    </div>
    {{-- END PRODUCT --}}
@include('news.multicart-theme.script')
<script>

</script>
@endsection
