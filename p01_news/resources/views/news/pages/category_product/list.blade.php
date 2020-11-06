@php
    use App\Helpers\URL;
@endphp
@if (!empty($item))
  @foreach ($item as $item)
  @php
      $name = $item['name'];
      $price = number_format($item['price']).'đ';
      $thumb = json_decode($item['thumb'],true);
      $thumb = asset("assmin/img/product/{$thumb[0]['name']}");
      $paramURL['category_id'] = $itemsCategory['id'];
      $paramURL['category_name'] = $itemsCategory['name'];
      $paramURL['product_name'] = $name;
      $paramURL['product_id'] = $item['id'];
      $link = URL::linkProduct($paramURL);
  @endphp
  <div class="col-xl-3 col-6 col-grid-box">
    <div class="product-box">
      <div class="img-wrapper">
        <a href="{{$link}}"><img src="{{$thumb}}" alt="" class="img-fluid "></a>
      </div>
      <div class="product-detail">
          <div>
              <a href="{{$link}}"><h6>{{ $name }}</h6></a>
              <h4>{{ $price }}</h4>
          </div>
      </div>
    </div>
  </div>
  @endforeach
@else
    NULL
@endif

